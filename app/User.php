<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;
    const VERIFIED_USER = '1';
    const UNVERIFIED_USER = '0';
    const ADMIN_USER = "true";
    const REGULAR_USER = "false";

    protected $table='users';  
    protected $dates = ['deleted_at'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password',                
        'phone',
        'city',
        'street',
        'address',
        'house_number',
        'verified',
        'verification_token',
        'admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
        'verification_token'
    ];

    //mutators  and accessors
    public function setNameAttribute($name){
        $this->attributes['name'] = strtolower($name);

    }

    public function getNameAttribute($name){
        return ucwords($name);
    }

    public function setEmailttribute($email)
    {
        $this->attributes['email'] = strtolower($email);
    }


    public function isVerified()
    {
        return $this->verified == User::VERIFIED_USER; 
    }

    public function isAdmin()
    {
        return $this->admin == User::ADMIN_USER;
    }

    public static function generateVerificationCode()
    {
        // $str = rand();
        // $result = hash("sha256", $str); 
        return Str::random(40);
    }




}
