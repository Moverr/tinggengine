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



        if ($this->getUsername() == null || strlen($this->getUsername()) == 0) {
            throw new Exception("Username is Mandatory", 403);
        }


        if ($this->getPassword() == null) {
            throw new Exception("Password is Mandatory", 403);
        }

        if ($this->getRepassword() == null) {
            throw new Exception("Password is Mandatory", 403);
        }



        // if ($this->getRoleId() == null) {
        //     throw new Exception("Role  is Mandatory", 403);
        // }


        if ($this->getPassword() != $this->getRepassword()) {
            throw new Exception("Passwords do not match", 403);
        }


        return true;
    }

    
    


     
}
