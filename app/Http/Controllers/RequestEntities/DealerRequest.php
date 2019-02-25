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
class DealerRequest {

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

    function getJoindate() {
        return $this->joindate;
    }

    function setJoindate($joindate) {
        $this->joindate = $joindate;
    }

    function getReference_id() {
        return $this->reference_id;
    }

    function setReference_id($reference_id) {
        $this->reference_id = $reference_id;
    }

    function validate() {
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
