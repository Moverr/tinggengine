<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Helpers;

/**
 * Description of BadRequestException
 *
 * @author mover  
 */
class BadRequestException {
    //put your code here
    
    private $mesage;
    
    function __construct($mesage) {
        $this->mesage = $mesage;
    }
    
    function throwException($message){
        throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException($mesage);
    }
    
    

    
}
