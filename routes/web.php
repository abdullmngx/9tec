<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

Route::get('/', function () {
    return redirect(route('user.login'));
});

Route::prefix('user')->group(function () {
    Route::get('login', [UserController::class, 'login'])->name('user.login');
    Route::post('login', [UserController::class, 'authenticate'])->name('user.authenticate');
    Route::get('register/{ref_id?}', [UserController::class, 'register'])->name('user.register');
    Route::post('register', [UserController::class, 'store'])->name('user.store');

    Route::group(['middleware' => ['auth', 'verified']], function () {
        Route::get('dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
        Route::get('courses', [UserController::class, 'courses'])->name('user.courses');
        Route::get('/find-courses', [UserController::class, 'findCourses'])->name('user.find_courses');
        Route::get('/courses/add/{course_id}', [UserController::class, 'addCourse'])->name('user.add_course');
        Route::get('logout', [UserController::class, 'logout'])->name('user.logout');

        Route::prefix('affiliate')->group(function () {
            Route::get('activate', [UserController::class, 'activateAffiliate'])->name('user.activate_affiliate');
            Route::get('dashboard', [UserController::class, 'affiliateDashboard'])->name('user.affiliate_dashboard');
        });
        Route::get('/course/completed/{user_course_id}', [UserController::class, 'markCompleted'])->name('user.mark_completed');
        Route::post('/course/activate', [UserController::class, 'activateCourse'])->name('user.activate_course');
        Route::get('/account', [UserController::class, 'setBank'])->name('user.profile');
        Route::post('/account', [UserController::class, 'saveBank'])->name('user.save_bank');
        Route::get('/withdrawals', [UserController::class, 'withdrawals'])->name('user.withdrawals');
    });
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
