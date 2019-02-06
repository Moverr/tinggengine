<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stockists extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reference_id', 'join_date', 'user_id', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['user_id'];
    protected $table = 'stockists';

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

    public function Users() {
        return $this->belongsTo('App\User', 'foreign_key', 'user_id');
    }

}
