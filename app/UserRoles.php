<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    protected $table = 'userrole';

    
     const CREATED_AT = null;
    const UPDATED_AT = null;

    
    public function Users() {
        return $this->belongsTo('App\User', 'foreign_key', 'user_id');
    }

    public function Roles() {
        return $this->belongsTo('App\Roles', 'foreign_key', 'role_id');
    }

}
