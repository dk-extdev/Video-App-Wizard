<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    const DAILY_LIMIT_STANDARD = 50;
    const DAILY_LIMIT_PREMIUM = 75;

    protected $table = 'users';
    protected $guard = "user";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getIsPremiumAttribute()
    {
        return ($this->type === 'Premium');
    }

}
