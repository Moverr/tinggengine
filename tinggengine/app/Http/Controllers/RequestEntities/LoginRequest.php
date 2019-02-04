<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\RequestEntities;

/**
 * Description of LoginRequest
 *
 * @author mover  
 */
class LoginRequest {

    //put your code here
    private $username;
    private $password;

    function __construct() {
        
    }

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

     function validate() {
         if($this->getUsername() == null){
                throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Username is mandatory");
         }
         
         if($this->getPassword() == null){
                throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Password is mandatory");
         }
         
         
         
     }
     
}
