<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\ResponseEntities;

/**
 * Description of ProductCategoryResponse
 *
 * @author mover  
 */
class ProductCategoryResponse {

    private $id;
    private $name;
    private $code;
    private $status;
    private $createdBy;
    private $dateCreated;
    private $updatedBy;
    private $dateUpdated;

    function __construct($name, $code) {
        $this->name = $name;
        $this->code = $code;
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

    function getStatus() {
        return $this->status;
    }

    function getCreatedBy() {
        return $this->createdBy;
    }

    function getDateCreated() {
        return $this->dateCreated;
    }

    function getUpdatedBy() {
        return $this->updatedBy;
    }

    function getDateUpdated() {
        return $this->dateUpdated;
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

    function setStatus($status) {
        $this->status = $status;
    }

    function setCreatedBy($createdBy) {
        $this->createdBy = $createdBy;
    }

    function setDateCreated($dateCreated) {
        $this->dateCreated = $dateCreated;
    }

    function setUpdatedBy($updatedBy) {
        $this->updatedBy = $updatedBy;
    }

    function setDateUpdated($dateUpdated) {
        $this->dateUpdated = $dateUpdated;
    }

    public function toJson() {
        return \GuzzleHttp\json_encode([
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'status' => $this->status,
            'createdBy' => $this->createdBy,
            'dateUpdated' => $this->dateUpdated
        ]);
    }

}
