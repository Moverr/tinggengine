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



        if ($this->getProduct_id() == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Product  is Mandatory");
        }

        if ($this->getReference_id() == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Reference ID   is Mandatory");
        }



        if ($this->getQuantity() == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Quantity is Mandatory");
        }



        if ($this->getUnit_selling_price() == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException(" Unit Selling Price  is Mandatory");
        }


        if ($this->getUnit_purchase_price() == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException(" Unit Purchase Price  is Mandatory");
        }




        if ($this->getUnit_measure() == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException(" Unit measure is Mandatory");
        }



        return true;
    }

    
    


}
