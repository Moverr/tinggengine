<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\ResponseEntities;

/**
 * Description of PurchaseOrderItemsResponse
 *
 * @author mover  
 */
class PurchaseOrderItemsResponse {

    //put your code here
    private $id;
    private $purchase_order;
    private $product;
    private $quantity;
    private $unit_selling_price;
    private $total_selling_price;
    private $status;
    private $created_by;
    private $date_created;

    function __construct() {
        
    }

    function getId() {
        return $this->id;
    }

    function getPurchase_order() {
        return $this->purchase_order;
    }

    function getProduct() {
        return $this->product;
    }

    function getQuantity() {
        return $this->quantity;
    }

    function getUnit_selling_price() {
        return $this->unit_selling_price;
    }

    function getTotal_selling_price() {
        return $this->total_selling_price;
    }

    function getStatus() {
        return $this->status;
    }

    function getCreated_by() {
        return $this->created_by;
    }

    function getDate_created() {
        return $this->date_created;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPurchase_order($purchase_order) {
        $this->purchase_order = $purchase_order;
    }

    function setProduct($product_id) {
        $this->product = $product_id;
    }

    function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    function setUnit_selling_price($unit_selling_price) {
        $this->unit_selling_price = $unit_selling_price;
    }

    function setTotal_selling_price($total_selling_price) {
        $this->total_selling_price = $total_selling_price;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setCreated_by($created_by) {
        $this->created_by = $created_by;
    }

    function setDate_created($date_created) {
        $this->date_created = $date_created;
    }

    public function toJson() {
        return \GuzzleHttp\json_encode($this->toString());
    }

    public function toString() {
        return ([
            'id' => $this->id,
            'purchase_order' => $this->purchase_order,
            'product' => $this->product,
            'quantity' => $this->quantity,
            'unit_selling_price' => $this->unit_selling_price,
            'total_selling_price' => $this->total_selling_price,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'date_created' => $this->date_created,
        ]);
    }

}
