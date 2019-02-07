<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\RequestEntities;

/**
 * Description of StockistRequest
 *
 * @author mover  
 */
class StockistRequest {

    //put your code here
    private $firstname;
    private $lastname;
    private $companyname;
    private $phonenumber;
    private $username;
    private $password;

    function __construct() {
        
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

    function getPhonenumber() {
        return $this->phonenumber;
    }

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
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

    function setPhonenumber($phonenumber) {
        $this->phonenumber = $phonenumber;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function validate() {



        if ($this->getFirstname() == null && $this->getLastname()) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Names are  Mandatory");
        }

        if ($this->getCompanyname() == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Company/Shop Name  is Mandatory");
        }



        if ($this->getPhonenumber() == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Default Phone Number  is Mandatory");
        }





        return true;
    }

}
