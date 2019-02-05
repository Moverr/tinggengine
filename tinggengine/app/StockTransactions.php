<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockTransactions extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stock_id', 'quantity', 'unit_selling_price', 'unit_purchase_price', 'transaction_type', 'unit_measure', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    protected $table = 'stocktransactions';

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

}
