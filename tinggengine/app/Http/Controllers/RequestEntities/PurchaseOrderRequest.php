<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\RequestEntities;

/**
 * Description of PurchaseOrderRequest
 *
 * @author mover  
 */
class PurchaseOrderRequest {

    //put your code here
    private $id;
    private $stockist_id;
    private $reference_id;
    private $order_date;
    private $total_amount;
    private $status;
    private $created_by;
    private $updated_by;
    private $date_created;
    private $date_updated;
    
    function __construct() {
        
    }

    function getId() {
        return $this->id;
    }

    function getStockist_id() {
        return $this->stockist_id;
    }

    function getReference_id() {
        return $this->reference_id;
    }

    function getOrder_date() {
        return $this->order_date;
    }

    function getTotal_amount() {
        return $this->total_amount;
    }

    function getStatus() {
        return $this->status;
    }

    function getCreated_by() {
        return $this->created_by;
    }

    function getUpdated_by() {
        return $this->updated_by;
    }

    function getDate_created() {
        return $this->date_created;
    }

    function getDate_updated() {
        return $this->date_updated;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setStockist_id($stockist_id) {
        $this->stockist_id = $stockist_id;
    }

    function setReference_id($reference_id) {
        $this->reference_id = $reference_id;
    }

    function setOrder_date($order_date) {
        $this->order_date = $order_date;
    }

    function setTotal_amount($total_amount) {
        $this->total_amount = $total_amount;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setCreated_by($created_by) {
        $this->created_by = $created_by;
    }

    function setUpdated_by($updated_by) {
        $this->updated_by = $updated_by;
    }

    function setDate_created($date_created) {
        $this->date_created = $date_created;
    }

    function setDate_updated($date_updated) {
        $this->date_updated = $date_updated;
    }

    
    

}
