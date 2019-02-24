<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reference_id', 'join_date','phone_number', 'user_id', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['user_id'];
    protected $table = 'dealers';

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

    public function Author() {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }
    
     public function User() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

}
