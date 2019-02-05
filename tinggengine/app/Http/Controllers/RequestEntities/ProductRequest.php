<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\RequestEntities;

/**
 * Description of ProductRequest
 *
 * @author mover  
 */
class ProductRequest {

    private $id;
    private $name;
    private $code;
    private $categoryId;
    private $createdBy;
    private $dateCreated;

    function __construct($name, $code, $categoryId) {
        $this->name = $name;
        $this->code = $code;
        $this->categoryId = $categoryId;
    }

        function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getCode() {
        return $this->code;
    }

    function getCategoryId() {
        return $this->categoryId;
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

    function setName($name) {
        $this->name = $name;
    }

    function setCode($code) {
        $this->code = $code;
    }

    function setCategoryId($categoryId) {
        $this->categoryId = $categoryId;
    }

    function setCreatedBy($createdBy) {
        $this->createdBy = $createdBy;
    }

    function setDateCreated($dateCreated) {
        $this->dateCreated = $dateCreated;
    }

    function validate() {



        if ($this->getCode() == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Product Code is Mandatory");
        }

        if ($this->getName() == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("product Name is Mandatory");
        }



        if ($this->getCategoryId() == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Product Category   is Mandatory");
        }





        return true;
    }

}
