<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Solunes\Master\App\Traits\UserPermission;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract {
    
    use Authenticatable, Authorizable, CanResetPassword, SoftDeletes, UserPermission;

    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];
    protected $dates = ['deleted_at','last_login'];

    /* Login rules */
    public static $rules_login = array(
        'user'=>'required',
        'password'=>'required|min:6',
    );

    /* Edit Pass rules */
    public static $rules_edit_pass = array(
        'password'=>'required|min:6|confirmed',
        'password_confirmation'=>'required|min:6',
    );

    /* Creating rules */
    public static $rules_create = array(
        'email'=>'email|required_without_all:cellphone,username',
        'cellphone'=>'required_without_all:email,username',
        'username'=>'required_without_all:email,cellphone',
        'password'=>'required|min:6',
        'name'=>'required',
        'status'=>'required',
        'notifications_app'=>'required',
        'notifications_email'=>'required',
        'notifications_sms'=>'required',
        'role_user'=>'required',
    );

    /* Creating rules */
    public static $rules_edit = array(
        'email'=>'email|required_without_all:cellphone,username',
        'cellphone'=>'required_without_all:email,username',
        'username'=>'required_without_all:email,cellphone',
        'name'=>'required',
        'status'=>'required',
        'notifications_app'=>'required',
        'notifications_email'=>'required',
        'notifications_sms'=>'required',
        'role_user'=>'required',
    );

    public function site() {
        return $this->belongsTo('Solunes\Master\App\Site');
    }

    public function registry_a() {
        return $this->hasMany('App\RegistryA');
    }

    public function registry_b() {
        return $this->hasMany('App\RegistryB');
    }

    public function activities() {
        return $this->hasMany('Solunes\Master\App\Activity');
    }

    public function notifications() {
        return $this->hasMany('Solunes\Master\App\Notification')->orderBy('created_at','DESC');
    }

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = bcrypt($value);
    }

}