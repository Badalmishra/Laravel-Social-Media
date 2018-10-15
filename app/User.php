<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','api_token','pic','bio','usercover','email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function photo()
    {
      return $this->hasMany('App\photo');
    }
    public function like()
    {
      return $this->hasMany('App\like');
    }
    public function follows()
    {
      return $this->hasMany('App\follow','followers');
    }
    public function followers()
    {
      return $this->hasMany('App\follow');
    }
}
