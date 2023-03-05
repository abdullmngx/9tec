<?php

namespace App\Http\Controllers;

use App\Models\ActivationCoupon;
use App\Models\Configuration;
use App\Models\Course;
use App\Models\User;
use App\Models\UserCourse;
use App\Models\UserEarning;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register($ref_id = null)
    {
        return view('auth.register', ['ref_id' => Crypt::decryptString($ref_id)]);
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->remember))
        {
            return redirect()->intended(route('user.dashboard'));
        }
        else
        {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required',
            'password' => 'required|confirmed'
        ]);

        $details = $request->except('_token', 'password_confirmation');
        $details['password'] = Hash::make($request->password);
        $user = User::create($details);
        Auth::login($user, true);
        return redirect()->intended(route('user.dashboard'));
    }

    public function dashboard()
    {
        $stat = [
            'total_courses' => UserCourse::where('user_id', auth()->id())->count(),
            'active_courses' => UserCourse::where('user_id', auth()->id())->where('status', 'active')->count(),
            'inactive_courses' => UserCourse::where('user_id', auth()->id())->where('status', 'inactive')->count()
        ];
        $courses = UserCourse::where('user_id', auth()->id())->get();
        return view('user.dashboard', ['user' => auth()->user(), 'courses' => $courses, 'stat' => $stat]);
    }

    public function affiliateDashboard()
    {
        $user = auth()->user();
        $refs = User::where('ref_id', $user->id)->paginate(15);
        if ($user->affiliate_status != 'active')
        {
            return redirect(route('user.dashboard'));
        }
        $stat = [
            'total_refs' => User::where('ref_id', $user->id)->count(),
            'active_refs' => $refs->where('is_active', true)->count(),
        ];
        return view('user.affiliate_dashboard', ['user' => $user, 'stat' => $stat, 'refs' => $refs]);
    }

    public function addCourse($course_id)
    {
        $user = auth()->user();
        if (!UserCourse::where('user_id', $user->id)->where('course_id', $course_id)->exists())
        {
            UserCourse::create([
                'user_id' => $user->id,
                'course_id' => $course_id
            ]);
            return back()->with('message', 'Course Added');
        }
        
        return back()->withErrors(['error' => 'This course is already added your list']);
    }

    public function findCourses()
    {
        $courses = Course::all();
        return view('user.find_courses', ['courses' => $courses]);
    }

    public function activateAffiliate()
    {
        User::where('id',auth()->id())->update(['affiliate_status' => 'active']);
        return back()->with('message', 'you are now an affiliate, <a href="'.route('user.affiliate_dashboard').'">Click here to proceed to your dashboard</a>');
    }

    public function courses()
    {
        $courses = UserCourse::where('user_id', auth()->id())->get();
        return view('user.courses', ['courses' => $courses]);
    }

    public function markCompleted($user_course_id)
    {
        UserCourse::where('id', $user_course_id)->update(['status' => 'completed']);
        return back()->with('message', 'Course marked as completed');
    }

    public function activateCourse(Request $request)
    {
        try 
        {
            $request->validate(['coupon' => 'required']);
            $code = $request->coupon;
            $user_course_id = $request->user_course_id;
            $user_course = UserCourse::find($user_course_id);
            $user = User::find($user_course->user_id);
            $coupon = ActivationCoupon::where('code', $code)->first();
            $config = Configuration::where('name', 'referral_commission')->first();

            if (!is_null($coupon))
            {
                if ($coupon?->status == 'unused')
                {
                    if ($coupon?->amount == $user_course->course_amount)
                    {
                        DB::beginTransaction();
                        UserCourse::where('id', $user_course_id)->update(['status' => 'active']);
                        if (!is_null($user->ref_id))
                        {
                            if (!UserEarning::where('from', $user->id)->exists())
                            {
                                UserEarning::create([
                                    'user_id' => $user->ref_id,
                                    'from' => $user->id,
                                    'amount' => $this->percentage($config->value, $user_course->course_amount),
                                    'type' => 'referral'
                                ]);
                            }
                        }
                        $coupon->update(['status' => 'used']);
                        DB::commit();
                        return ['error' => false, 'message' => 'Course activated', 'status' => '200'];
                    }
                    else
                    {
                        return ['error' => true, 'message' => 'This code cannot be used to activate this course!', 'status' => 403];
                    }
                }
                else
                {
                    return ['error' => true, 'message' => 'The code you entered has already been used!', 'status' => 403];
                }
            }else
            {
                return ['error' => true, 'message' => 'Invalid activation code!', 'status' => 404];
            }
        }
        catch (ValidationException $e)
        {
            return ['error' => true, 'data' => $e->errors(), 'status' => '400'];
        }
        catch (Exception $e)
        {
            DB::rollBack();
        }
    }

    protected function percentage($per, $num)
    {
        return $per/100 * $num;
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('user.login'));
    }

    public function setBank()
    {
        return view('user.profile');
    }

    public function saveBank(Request $request)
    {
        $request->validate([
            'account_name' => 'required',
            'account_number' => 'required|numeric',
            'bank' => 'required'
        ]);
    }
}
