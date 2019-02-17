<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\RequestEntities;
use Exception;

/**
 * Description of ProductCategoryRequest
 *
 * @author mover  
 */
class ProductCategoryRequest {

    private $id;
    private $name;
    private $code;
    private $status;
    private $createdBy;

    function __construct($name, $code) {
        $this->name = $name;
        $this->code = $code;
    }

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
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
            throw new  Exception("Product Code is mandatory",403);
        }

        if ($this->getName() == null) {
            throw new Exception("Product Name is mandatory",403);
        }
    }

}
