<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\ResponseEntities;

/**
 * Description of StockResponse
 *
 * @author mover  
 */
class StockResponse {

    private $id;
    private $reference;
    private $product;
    private $quantity;
    private $unitsellingprice;
    private $unitpurchaseprice;
    private $unitmeasure;
    private $status;
    private $createdBy;
    private $dateCreated;

    function __construct() {
        
    }

    function getId() {
        return $this->id;
    }

    function getReference() {
        return $this->reference;
    }

    function getProduct() {
        return $this->product;
    }

    function getQuantity() {
        return $this->quantity;
    }

    function getUnitsellingprice() {
        return $this->unitsellingprice;
    }

    function getUnitpurchaseprice() {
        return $this->unitpurchaseprice;
    }

    function getUnitmeasure() {
        return $this->unitmeasure;
    }

    function getStatus() {
        return $this->status;
    }

    function getCreatedBy() {
        return $this->createdBy;
    }

    function getDateCreated() {
        return $this->dateCreated;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setReference($reference) {
        $this->reference = $reference;
    }

    function setProduct($product) {
        $this->product = $product;
    }

    function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    function setUnitsellingprice($unitsellingprice) {
        $this->unitsellingprice = $unitsellingprice;
    }

    function setUnitpurchaseprice($unitpurchaseprice) {
        $this->unitpurchaseprice = $unitpurchaseprice;
    }

    function setUnitmeasure($unitmeasure) {
        $this->unitmeasure = $unitmeasure;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setCreatedBy($createdBy) {
        $this->createdBy = $createdBy;
    }

    function setDateCreated($dateCreated) {
        $this->dateCreated = $dateCreated;
    }

    public function toJson() {
        return \GuzzleHttp\json_encode($this->toString());
    }

    public function toString() {
        return ([
            'id' => $this->id,
            'reference' => $this->reference,
            'product' => $this->product,
            'quantity' => $this->quantity,
            'unitsellingprice' => $this->unitsellingprice,
            'unitpurchaseprice' => $this->unitpurchaseprice,
            'unitmeasure' => $this->unitmeasure,
            'status' => $this->status,
            'createdBy' => $this->createdBy,
            'dateCreated' => $this->dateCreated
        ]);
    }

}
