<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password','status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];


    protected $table = 'users';

     const CREATED_AT = 'date_created';
     const UPDATED_AT = 'date_updated';

}
