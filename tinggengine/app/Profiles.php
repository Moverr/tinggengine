<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profiles extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    protected $table = 'profiles';

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

    
    
    
    
}
