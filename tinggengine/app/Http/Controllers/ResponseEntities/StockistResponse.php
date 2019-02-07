<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\ResponseEntities;

/**
 * Description of StockistResponse
 *
 * @author mover  
 */
class StockistResponse {

    private $id;
    private $firstname;
    private $lastname;
    private $companyname;
    private $reference_id;
    private $countrycode;
    private $phonenumber;
    private $username;
    private $status;
    private $datecreated;
    private $createdBy;

    function __construct() {
        
    }

    function getId() {
        return $this->id;
    }

    function getFirstname() {
        return $this->firstname;
    }

    function getLastname() {
        return $this->lastname;
    }

    function getCompanyname() {
        return $this->companyname;
    }

    function getCountrycode() {
        return $this->countrycode;
    }

    function getPhonenumber() {
        return $this->phonenumber;
    }

    function getUsername() {
        return $this->username;
    }

    function getStatus() {
        return $this->status;
    }

    function getDatecreated() {
        return $this->datecreated;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    function setCompanyname($companyname) {
        $this->companyname = $companyname;
    }

    function setCountrycode($countrycode) {
        $this->countrycode = $countrycode;
    }

    function setPhonenumber($phonenumber) {
        $this->phonenumber = $phonenumber;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setDatecreated($datecreated) {
        $this->datecreated = $datecreated;
    }

    function getReference_id() {
        return $this->reference_id;
    }

    function setReference_id($reference_id) {
        $this->reference_id = $reference_id;
    }

    function getCreatedBy() {
        return $this->createdBy;
    }

    function setCreatedBy($createdBy) {
        $this->createdBy = $createdBy;
    }

    public function toJson() {
        return \GuzzleHttp\json_encode([
            'id' => $this->id,
            'name' => $this->firstname . '' . $this->lastname,
            'bussiness' => $this->companyname,
            'reference_id' => $this->reference_id,
            'createdBy' => $this->createdBy,
            'dateUpdated' => $this->dateUpdated
        ]);
    }

}
