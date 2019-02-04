<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\RequestEntities;

/**
 * Description of ProductCategoryRequest
 *
 * @author mover  
 */
class ProductCategoryRequest {

    private $name;
    private $code;
    private $status;
    private $createdBy;

    function __construct() {
        
    }

    function getName() {
        return $this->name;
    }

    function getCode() {
        return $this->code;
    }

    function getStatus() {
        return $this->status;
    }

    function getCreatedBy() {
        return $this->createdBy;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setCode($code) {
        $this->code = $code;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setCreatedBy($createdBy) {
        $this->createdBy = $createdBy;
    }

    function validate() {
        if ($this->getCode() == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Product Code is mandatory");
        }

        if ($this->getName() == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Product Name is mandatory");
        }
    }

}
