<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\RequestEntities;

use Exception;

/**
 * Description of StockistRequest
 *
 * @author mover  
 */
class DriverRequest {

    //put your code here
    private $id;
    private $firstname;
    private $lastname;
    private $companyname;
    private $countrycode;
    private $phonenumber;
    private $username;
    private $password;
    private $status;
    private $datecreated;
    private $joindate;
    private $reference_id;
    private $dealer_reference;
    private $dealer_id;

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

    function getPassword() {
        return $this->password;
    }

    function getStatus() {
        return $this->status;
    }

    function getDatecreated() {
        return $this->datecreated;
    }

    function getJoindate() {
        return $this->joindate;
    }

    function getReference_id() {
        return $this->reference_id;
    }

    function getDealer_reference() {
        return $this->dealer_reference;
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

    function setPassword($password) {
        $this->password = $password;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setDatecreated($datecreated) {
        $this->datecreated = $datecreated;
    }

    function setJoindate($joindate) {
        $this->joindate = $joindate;
    }

    function setReference_id($reference_id) {
        $this->reference_id = $reference_id;
    }

    function setDealer_reference($dealer_reference) {
        $this->dealer_reference = $dealer_reference;
    }

    function getDealer_id() {
        return $this->dealer_id;
    }

    function setDealer_id($dealer_id) {
        $this->dealer_id = $dealer_id;
    }

    function validate() {

        if ($this->getDealer_reference() == null || $this->getDealer_id() == null) {
            throw new Exception("Dealer Reference is  Mandatory");
        }


        if ($this->getFirstname() == null || $this->getLastname() == null) {
            throw new Exception("Names are  Mandatory");
        }

        if ($this->getCompanyname() == null) {
            throw new Exception("Company/Shop Name  is Mandatory", 403);
        }


        if ($this->getPhonenumber() == null) {
            throw new Exception("Default Phone Number  is Mandatory", 403);
        }


        return true;
    }

}
