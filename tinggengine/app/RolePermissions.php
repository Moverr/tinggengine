<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolePermissions extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'permission_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    protected $table = 'rolepermission';

    public function Role() {
        return $this->belongsTo('App\Roles', 'foreign_key', 'role_id');
    }
    

    public function Permission() {
        return $this->belongsTo('App\Permissions', 'foreign_key', 'permission_id');
    }

}
