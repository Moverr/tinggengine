<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Http\Helpers\Utils;
use App\Stock;
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
    private $util;

    function __construct() {
        $this->util = new Utils();
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new PurchaseService();
        }
        return self::$instance;
    }

    public function getList($offset, $limit, $autneticaton_response = null) {
        $purchaseOrders = PurchaseOrders::offset($offset)->limit($limit)->get();


        $purchaseorderresponses = [];
        foreach ($purchaseOrders as $record) {
            $purchaseorderresponses [] = $this->populate($record)->toJson();
        }

        return $purchaseorderresponses;
    }

    public function get($id, $autneticaton_response = null) {
        $purchaseorder = PurchaseOrders::where('id', $id)->get();
        if ($purchaseorder == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Record does not exist in the daabase");
        }

        $productResponse = $this->populate($purchaseorder[0]);
        return $productResponse->toJson();
    }

    public function save($request, $autneticaton_response = null) {
        $stockist_id = $request['stockist_id'];
        $order_date = $request['order_date'];
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

    public function update($request, $authentication = null) {
        $stockist_id = $request['stockist_id'];
        $order_date = $request['reference_id'];
        $reference_id = $this->util->incrementalHash(5);

        $stockRequest = new PurchaseOrderRequest();

        if ($request['id'] == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Mandatory field ID is missing");
        }

        $stockRequest->setId($request['id']);
        $stockRequest->validate();

        $stockRequest = Stock::where('id', $stockRequest->getId())->first();
        if ($product == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Record does not exist in the daabase");
        }




        $stock->product_id = $product_id;
        $stock->reference_id = "ReferenceID";
        $stock->quantity = $quantity;
        $stock->unit_selling_price = $unit_selling_price;
        $stock->unit_purchase_price = null;
        $stock->status = 'ACTIVE';
        $stock->update();

        $stockResponse = $this->populate($stock);
        return $stockResponse->toJson();
    }

    public function archive($id, $autneticaton_response = null) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);


        $product = ProductCategories::where('id', $id)->first();
        if ($product == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Record does not exist in the daabase");
        }
        $product->status = 'ARCHIVED';
        $product->update();
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
