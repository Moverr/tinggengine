<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\RequestEntities;
use Exception;
/**
 * Description of PurchaseOrderItemsRequest
 *
 * @author mover  
 */
class PurchaseOrderItemsRequest {
    //put your code here
    private $id;
    private $purchase_order;
    private $product_id;
    private $quantity;
    private $unit_selling_price;
    private $total_selling_price;
    private $status;
    private $created_by;
    
    function __construct() {
        
    }
    
    function getId() {
        return $this->id;
    }

    function getPurchase_order() {
        return $this->purchase_order;
    }

    function getProduct_id() {
        return $this->product_id;
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

    function setId($id) {
        $this->id = $id;
    }

    function setPurchase_order($purchase_order) {
        $this->purchase_order = $purchase_order;
    }

    function setProduct_id($product_id) {
        $this->product_id = $product_id;
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

    
    


    
}
