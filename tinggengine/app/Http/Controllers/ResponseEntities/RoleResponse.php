<?php

namespace App\Http\Controllers\ResponseEntities;
 

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RoleResponse
 *
 * @author mover  
 */
class RoleResponse {
    //put your code here
    private $id;
    private $name;
    private $permissions;
    
    function __construct() {
        
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getPermissions() {
        return $this->permissions;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setPermissions($permissions) {
        $this->permissions = $permissions;
    }


    
}
