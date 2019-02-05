<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code', 'description', 'is_system', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    protected $table = 'roles';

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';
}
