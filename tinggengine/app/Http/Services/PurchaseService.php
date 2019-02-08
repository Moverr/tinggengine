<?php

namespace App\Http\Services;

use App\PurchaseOrders;
use App\Http\Controllers\ResponseEntities\PurchaseOrderResponse;
use App\Http\Controllers\RequestEntities\PurchaseOrderRequest;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PurchaseService
 *
 * @author mover  
 */
class PurchaseService {

    //put your code here

    private static $instance;

    function __construct() {
        
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new PurchaseService();
        }
        return self::$instance;
    }

    public function getList($offset, $limit) {
        $purchaseOrders = PurchaseOrders::offset($offset)->limit($limit)->get();


        $purchaseorderresponses = [];
        foreach ($purchaseOrders as $record) {
            $purchaseorderresponses [] = $this->populate($record)->toJson();
        }

        return $purchaseorderresponses;
    }

    public function populate($purchaseorder) {
        $purchaseorderresponse = new PurchaseOrderResponse();
        $purchaseorderresponse->setStockist_id($purchaseorder->stockist_id);
        $purchaseorderresponse->setOrder_date($purchaseorder->order_date);
        $purchaseorderresponse->setReference_id($purchaseorder->reference_id);
        $purchaseorderresponse->setTotal_amount($purchaseorder->total_amount);
        $purchaseorderresponse->setStatus($purchaseorder->status);
        $purchaseorderresponse->setCreated_by($purchaseorder->created_by);
        $purchaseorderresponse->setDate_created($purchaseorder->date_created);
        $purchaseorderresponse->setId($purchaseorder->id);

        return $purchaseorderresponse;
    }

}
