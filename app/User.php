<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'user_name', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function get_user()
    {
    	return $this->name;
    }

    public function get_user_id()
    {
        return $this->id;
    }

    public function get_user_contact_number()
    {
        return $this->contact_number;
    }

    public function get_user_username()
    {
        return $this->username;
    }

    public function get_user_last_login()
    {
        return $this->last_login_date;
    }

    public function get_user_role_id()
    {
        return $this->user_role_id;
    }

    public function get_user_position()
    {
        return $this->position;
    }

    public function get_user_department_id()
    {
        return $this->department_id;
    }
    
}
