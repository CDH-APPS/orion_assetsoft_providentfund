<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Usertype extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['role_name', 'role_description'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

}
