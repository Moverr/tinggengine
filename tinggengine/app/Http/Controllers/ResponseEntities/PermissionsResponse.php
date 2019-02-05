<?php
namespace App\Http\Controllers\ResponseEntities;
 

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PermissionsResponse
 *
 * @author mover  
 */
class PermissionsResponse {
    private $id;
    private $name; 
    private $grouping;
    
    
    function __construct() {
        
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getGrouping() {
        return $this->grouping;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setGrouping($grouping) {
        $this->grouping = $grouping;
    }


    
}
