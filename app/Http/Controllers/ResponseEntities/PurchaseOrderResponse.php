<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\ResponseEntities;

/**
 * Description of PurchaseOrderResponse
 *
 * @author mover  
 */
class PurchaseOrderResponse {

    //put your code here
    private $id;
    private $stockist;
    private $reference_id;
    private $order_date;
    private $total_amount;
    private $purchase_items;
    private $status;
    private $created_by;
    private $updated_by;
    private $date_created;
    private $date_updated;

    function getId() {
        return $this->id;
    }

    function getStockist() {
        return $this->stockist;
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

    function getPurchase_items() {
        return $this->purchase_items;
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

    function setStockist($stockist) {
        $this->stockist = $stockist;
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

    function setPurchase_items($purchase_items) {
        $this->purchase_items = $purchase_items;
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

    public function toJson() {
        return \GuzzleHttp\json_encode($this->toString());
    }
    
    public function toString(){
        return ([
            'id' => $this->id,
            'stockist' => $this->stockist,
            'reference_id' => $this->reference_id,
            'order_date' => $this->order_date,
            'total_amount' => $this->total_amount,
            'items'=>$this->purchase_items,
            'status' => $this->status,
            'createdBy' => $this->created_by,
            'date_created' => $this->date_created
        ]);
    }
    

}
