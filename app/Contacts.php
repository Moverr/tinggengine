<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'profile_id', 'contact_type', 'details',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    protected $table = 'contacts';

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

    public function contacts() {
        return $this->belongsTo('App\Profiles', 'foreign_key', 'profile_id');
    }

}
