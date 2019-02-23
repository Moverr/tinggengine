<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\RequestEntities;

/**
 * Description of ProfileRequest
 *
 * @author mover  
 */
class ProfileRequest {
    //put your code here
    
    private $firstname;
    private $lastname;
    private $compantname; 
    private $userid;
    
    function __construct() {
        
    }
    
    function getFirstname() {
        return $this->firstname;
    }

    function getLastname() {
        return $this->lastname;
    }

    function getCompantname() {
        return $this->compantname;
    }

    function getUserid() {
        return $this->userid;
    }

    function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    function setCompantname($compantname) {
        $this->compantname = $compantname;
    }

    function setUserid($userid) {
        $this->userid = $userid;
    }

    
    
        
    function validate() {



        if ($this->getCompantname() == null || strlen($this->getCompantname()) == 0) {
             $this->setCompantname("N/A");
        }


        if ($this->getFirstname() == null) {
            throw new Exception("First Name is Mandatory", 403);
        }

        if ($this->getLastname() == null) {
            throw new Exception("Last Name is Mandatory", 403);
        }

       


        return true;
    }

    
    


     
}
