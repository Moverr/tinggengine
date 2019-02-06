<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\ResponseEntities;

/**
 * Description of ProductResponse
 *
 * @author mover  
 */
class ProductResponse {

    private $id;
    private $name;
    private $code;
    private $status;
    private $category;
    private $createdBy;
    private $dateCreated;

    function __construct() {
        
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

    function getCategory() {
        return $this->category;
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

    function setCategory($categoryId) {
        $this->category = $categoryId;
    }

    function setCreatedBy($createdBy) {
        $this->createdBy = $createdBy;
    }

    function setDateCreated($dateCreated) {
        $this->dateCreated = $dateCreated;
    }

    function getStatus() {
        return $this->status;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    public function toJson() {
        return \GuzzleHttp\json_encode([
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'status' => $this->status,
            'category' => $this->category,
            'createdBy' => $this->createdBy,
            'dateCreated' => $this->dateCreated,
        ]);
    }

}
