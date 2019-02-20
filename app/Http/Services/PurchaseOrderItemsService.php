<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

/**
 * Description of PurchaseOrderItemsService
 *
 * @author mover  
 */
use App\Http\Controllers\ResponseEntities\PurchaseOrderItemsResponse;
use App\Http\Helpers\Utils;

class PurchaseOrderItemsService {
    //put your code here
    
    
    private static $instance;
    private $util;

    function __construct() {
        $this->util = new Utils();
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new PurchaseOrderItemsService();
        }
        return self::$instance;
    }

    
    
    public function populate($record){
        
        $items = new PurchaseOrderItemsResponse();
        $items->setPurchase_order($record->purchase_order_id);
        $items->setProduct_id($record->product_id);
        $items->setQuantity($record->quantity);
        $items->setUnit_selling_price($record->unit_selling_price);
        $items->setTotal_selling_price($record->total_selling_price);
        $items->setStatus($record->status);
         
        return $items;
    }
    
}
