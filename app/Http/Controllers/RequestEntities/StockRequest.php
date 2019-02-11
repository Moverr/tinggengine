<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\RequestEntities;

use Exception;
/**
 * Description of StockRequest
 *
 * @author mover  
 */
class StockRequest {

    private $id;
    private $product_id;
    private $reference_id;
    private $quantity;
    private $unit_selling_price;
    private $unit_purchase_price;
    private $unit_measure;
    private $date_created;
    private $date_updated;

    function __construct($product_id, $reference_id, $quantity, $unit_selling_price, $unit_purchase_price, $unit_measure) {
        $this->product_id = $product_id;
        $this->reference_id = $reference_id;
        $this->quantity = $quantity;
        $this->unit_selling_price = $unit_selling_price;
        $this->unit_purchase_price = $unit_purchase_price;
        $this->unit_measure = $unit_measure;
    }

    function getId() {
        return $this->id;
    }

    function getProduct_id() {
        return $this->product_id;
    }

    function getReference_id() {
        return $this->reference_id;
    }

    function getQuantity() {
        return $this->quantity;
    }

    function getUnit_selling_price() {
        return $this->unit_selling_price;
    }

    function getUnit_purchase_price() {
        return $this->unit_purchase_price;
    }

    function getUnit_measure() {
        return $this->unit_measure;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setProduct_id($product_id) {
        $this->product_id = $product_id;
    }

    function setReference_id($reference_id) {
        $this->reference_id = $reference_id;
    }

    function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    function setUnit_selling_price($unit_selling_price) {
        $this->unit_selling_price = $unit_selling_price;
    }

    function setUnit_purchase_price($unit_purchase_price) {
        $this->unit_purchase_price = $unit_purchase_price;
    }

    function setUnit_measure($unit_measure) {
        $this->unit_measure = $unit_measure;
    }

    function getDate_created() {
        return $this->date_created;
    }

    function getDate_updated() {
        return $this->date_updated;
    }

    function setDate_created($date_created) {
        $this->date_created = $date_created;
    }

    function setDate_updated($date_updated) {
        $this->date_updated = $date_updated;
    }

    function validate() {



        if ($this->getProduct_id() == null) {
            throw new Exception("Product  is Mandatory", 403);
        }

        if ($this->getReference_id() == null) {
            throw new Exception("Reference ID   is Mandatory", 403);
        }



        if ($this->getQuantity() == null) {
            throw new Exception("Quantity is Mandatory", 403);
        }



        if ($this->getUnit_selling_price() == null) {
            throw new Exception(" Unit Selling Price  is Mandatory", 403);
        }


        if ($this->getUnit_purchase_price() == null) {
            throw new Exception(" Unit Purchase Price  is Mandatory", 403);
        }




        if ($this->getUnit_measure() == null) {
            throw new Exception(" Unit measure is Mandatory",403);
        }



        return true;
    }

}
