<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code', 'category_id', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    protected $table = 'products';

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

    public function Category() {
        return $this->hasOne('App\ProductCategories', 'id', 'category_id');
    }
    
     public function Author() {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

}
