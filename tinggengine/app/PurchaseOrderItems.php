<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItems extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'purchase_order_id', 'product_id', 'quantity', 'unit_selling_price', 'total_selling_price', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    protected $table = 'purchaseorderitems';

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';
    
    
    
    public function Stockist() {
        return $this->belongsTo('App\Stockists', 'foreign_key', 'stockist_id');
    }
    
    

}
