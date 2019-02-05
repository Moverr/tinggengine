<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\RequestEntities;

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

    function __construct() {
        
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
    
      function validate() {


        
        if ($this->getUsername() == null || strlen($this->getUsername()) == 0  ) {
             throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Username is Mandatory");
             
        }


        if ($this->getPassword() == null ) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Password is Mandatory");
              
        }

        if ($this->getRepassword() == null  ) {             
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Password is Mandatory");
        }



        if ($this->getRoleId() == null ) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Role  is Mandatory");
        }

        
        if($this->getPassword() != $this->getRepassword()){
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Passwords do not match");       
        }





        return true;
    }

    
    

}
