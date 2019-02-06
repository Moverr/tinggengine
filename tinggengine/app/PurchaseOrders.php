<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrders extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stockist_id', 'order_date', 'reference_id', 'total_amount', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    protected $table = 'purchaseorders';

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

    public function Stockist() {
        return $this->belongsTo('App\Stockists', 'foreign_key', 'stockist_id');
    }

}
