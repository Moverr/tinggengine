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

    public function getList($offset, $limit, $autnetication = null) {
        $purchaseOrders = PurchaseOrders::offset($offset)->limit($limit)->get();


        $purchaseorderresponses = [];
        foreach ($purchaseOrders as $record) {
            $purchaseorderresponses [] = $this->populate($record)->toJson();
        }

        return $purchaseorderresponses;
    }

    public function get($id, $authenctication = null) {
        $purchaseorder = PurchaseOrders::where('id', $id)->get();
        if ($purchaseorder == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Record does not exist in the daabase");
        }

        $productResponse = $this->populate($purchaseorder[0]);
        return $productResponse->toJson();
    }
    
    public function save($request, $authentication = null){
         $stockist_id = $request['stockist_id'];
        $order_date = $request['reference_id'];
        $reference_id = $this->util->incrementalHash(5);
        $createdBy = $autneticaton_response->getId();

        $purchaseorderrequest = new PurchaseOrderRequest();
        $purchaseorderrequest->setStockist_id($stockist_id);
        $purchaseorderrequest->setOrder_date($order_date);
        $purchaseorderrequest->setCreated_by($createdBy);
        $purchaseorderrequest->setReference_id($reference_id);

        $purchaseorderrequest->validate();

        //todo:verify stockist. 
        //todo: verify that the stockist join date is not greater than 


        $purchaseorder = new PurchaseOrders();
        $purchaseorder->stockist_id = $purchaseorderrequest->getStockist_id();
        $purchaseorder->reference_id = $purchaseorderrequest->getReference_id();
        $purchaseorder->order_date = $purchaseorderrequest->getOrder_date();
        $purchaseorder->created_by = $purchaseorderrequest->getCreated_by();
        $purchaseorder->status = 'PENDING';
        $purchaseorder->save();

        $stockResponse = $this->populate($purchaseorder);
        return $stockResponse->toJson();
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
