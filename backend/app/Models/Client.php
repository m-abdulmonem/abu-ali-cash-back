<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Client extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'country', 'picture', 'email', 'username', 'password', 'status', 'account_type', 'rest_code', 'refer_code', 'api_token', 'is_admin', 'lang'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


//    public function offers()
//    {
//        return $this->belongsToMany('App\Models\Offer');
//    }

//    public function balances()
//    {
//        return $this->hasMany('App\Models\Balance');
//    }
//
//    public function VipCards()
//    {
//        return $this->hasMany('App\Models\VipCard');
//    }
}
