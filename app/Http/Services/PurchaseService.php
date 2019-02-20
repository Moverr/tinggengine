<?php

namespace App\Http\Services;

use App\Http\Helpers\Utils;
use App\Stock;
use App\PurchaseOrders;
use App\Http\Controllers\ResponseEntities\PurchaseOrderResponse;
use App\Http\Controllers\RequestEntities\PurchaseOrderRequest;
use App\Http\Controllers\RequestEntities\PurchaseOrderItemsRequest;
use App\PurchaseOrderItems;
use Exception;

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
        $purchaseOrders = PurchaseOrders::offset($offset)->limit($limit)->orderBy('date_created', 'desc')->get();
        $purchaseorderresponses = [];
        foreach ($purchaseOrders as $record) {

            $purchaseorderresponses [] = $this->populate($record)->toString();
        }

        return $purchaseorderresponses;
    }

    public function get($id, $autneticaton_response = null) {
        $purchaseorder = PurchaseOrders::where('id', $id)->get();
        if ($purchaseorder == null) {
            throw new Exception("Record does not exist in the daabase", 403);
        }



        $productResponse = $this->populate($purchaseorder[0]);
        return $productResponse->toString();
    }

    public function save($request, $autneticaton_response = null) {

        //todo: get stockist reference id 
        $stockist_reference = $request['stockist_reference'];
        $stockist = StockistService::getInstance()->checkrefence($stockist_reference);
        $stockist_id = $stockist['id'];



        $order_date = $request['order_date'];
        $reference_id = $this->util->incrementalHash(5);
        $items = $request['items'];
        $createdBy = $autneticaton_response->getId();

        $purchaseorderrequest = new PurchaseOrderRequest();
        $purchaseorderrequest->setStockist_id($stockist_id);
        $purchaseorderrequest->setOrder_date($order_date);
        $purchaseorderrequest->setCreated_by($createdBy);
        $purchaseorderrequest->setReference_id($reference_id);
        $purchaseorderrequest->setItems($items);
        $purchaseorderrequest->validate();

        //validate purchase order items

        $purchaseOrderItems = [];
        foreach ($items as $item) {
            $purchaseOrderItem = new PurchaseOrderItemsRequest();
            $purchaseOrderItem->setQuantity($item['quantity']);
            $purchaseOrderItem->setProduct_id($item['product_id']);
            $purchaseOrderItem->setUnit_selling_price($item['unit_selling_price']);
            $purchaseOrderItem->validate();
            $purchaseOrderItems[] = $purchaseOrderItem;
        }



        //todo:verify stockist. 
        //todo: verify that the stockist join date is not greater than 


        $purchaseorder = new PurchaseOrders();
        $purchaseorder->stockist_id = $purchaseorderrequest->getStockist_id();
        $purchaseorder->reference_id = $purchaseorderrequest->getReference_id();
        $purchaseorder->order_date = $purchaseorderrequest->getOrder_date();
        $purchaseorder->created_by = $purchaseorderrequest->getCreated_by();
        $purchaseorder->status = 'PENDING';
        $purchaseorder->save();

        //todo: add the items
        $totalvalue = 0;
        foreach ($purchaseOrderItems as $record) {
            $purchaseOrderItem = new PurchaseOrderItems();
            $purchaseOrderItem->purchase_order_id = $purchaseorder->id;
            $purchaseOrderItem->product_id = $record->getProduct_id();
            $purchaseOrderItem->quantity = $record->getQuantity();
            $purchaseOrderItem->unit_selling_price = $record->getUnit_selling_price();
            $totalselprice = $this->calculateTotalPrice($record->getUnit_selling_price(), $record->getQuantity());
            $purchaseOrderItem->total_selling_price = $totalselprice;
            $purchaseOrderItem->created_by = $purchaseorderrequest->getCreated_by();
            $purchaseOrderItem->save();
            $totalvalue += $totalselprice;
        }

        $purchaseorder->total_amount = $totalvalue;
        $purchaseorder->update();

        $stockResponse = $this->populate($purchaseorder);
        return $stockResponse->toString();
    }

    public function calculateTotalPrice($unitprice, $quantity) {
        return ($unitprice * $quantity);
    }

    public function update($request, $authentication = null) {
        $stockist_id = $request['stockist_id'];
        $order_date = $request['reference_id'];
        $reference_id = $this->util->incrementalHash(5);

        $stockRequest = new PurchaseOrderRequest();

        if ($request['id'] == null) {
            throw new Exception("Mandatory field ID is missing", 403);
        }

        $stockRequest->setId($request['id']);
        $stockRequest->validate();

        $stockRequest = Stock::where('id', $stockRequest->getId())->first();
        if ($product == null) {
            throw new Exception("Record does not exist in the daabase");
        }




        $stock->product_id = $product_id;
        $stock->reference_id = "ReferenceID";
        $stock->quantity = $quantity;
        $stock->unit_selling_price = $unit_selling_price;
        $stock->unit_purchase_price = null;
        $stock->status = 'ACTIVE';
        $stock->update();

        $stockResponse = $this->populate($stock);
        return $stockResponse->toString();
    }

    public function archive($id, $autneticaton_response = null) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);


        $product = ProductCategories::where('id', $id)->first();
        if ($product == null) {
            throw new Exception("Record does not exist in the daabase", 403);
        }
        $product->status = 'ARCHIVED';
        $product->update();
    }

    public function populate($purchaseorder) {
        $purchaseorderresponse = new PurchaseOrderResponse();
        $purchaseorderresponse->setStockist(
                [
                    "id" => $purchaseorder->Stockist->id,
                    "reference_id" => $purchaseorder->Stockist->reference_id
                ]
        );
        $purchaseorderresponse->setOrder_date($purchaseorder->order_date);
        $purchaseorderresponse->setReference_id($purchaseorder->reference_id);
        $purchaseorderresponse->setTotal_amount($purchaseorder->total_amount);
        $purchaseorderresponse->setStatus($purchaseorder->status);
        $purchaseorderresponse->setCreated_by($purchaseorder->Author->username);
        $purchaseorderresponse->setDate_created($this->util->convertToTimestamp($purchaseorder->date_created));
        $purchaseorderresponse->setId($purchaseorder->id);

        //   return var_dump($purchaseorder[0]->items);
        
        $itemsResponse = [];
        foreach ($purchaseorder->items as $item) {
            if ($item->status == 'ACTIVE') {
               $itemsResponse[]= PurchaseOrderItemsService::getInstance()->populate($item)->toString();
            }
        }

        $purchaseorderresponse->setPurchase_items($itemsResponse);
        
        return $purchaseorderresponse;
    }

}
