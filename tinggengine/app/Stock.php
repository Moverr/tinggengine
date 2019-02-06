<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'reference_id', 'quantity', 'unit_selling_price', 'unit_purchase_price', 'unit_measure', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    protected $table = 'stock';

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

    public function Stock() {
        return $this->belongsTo('App\Products', 'foreign_key', 'product_id');
    }

}
