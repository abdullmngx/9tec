<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'ref_id',
        'affiliate_status',
        'account_name',
        'account_number',
        'bank',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function fullName(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => ucwords($attributes['first_name'].' '.$attributes['last_name']),
        );
    }

    public function encryptedId(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => Crypt::encryptString($attributes['id'])
        );
    }

    public function isActive(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => UserCourse::where('user_id', $attributes['id'])->where('status', 'active')->orWhere('status', 'completed')->exists()
        );
    }

    public function totalEarnings(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => UserEarning::where('user_id', $attributes['id'])->sum('amount')
        );
    }

    public function totalWithdrawals(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => Withdrawal::where(['user_id' => $attributes['id'], 'status' => 'approved'])->sum('amount')
        );
    }

    public function balance(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->getAttribute('total_earnings') - $this->getAttribute('total_withdrawals')
        );
    }

    public function isBankSet(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes)
            {
                if (is_null($attributes['account_name']) || is_null($attributes['account_number']) || is_null($attributes['bank']))
                {
                    return false;
                }
                return true;
            } 
        );
    }
}
