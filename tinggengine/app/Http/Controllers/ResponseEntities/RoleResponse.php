<?php

namespace App\Http\Controllers\ResponseEntities;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use App\Http\Controllers\ResponseEntities\PermissionResponse;

/**
 * Description of RoleResponse
 *
 * @author mover  
 */
class RoleResponse {

    //put your code here
    private $id;
    private $name;
    private $code;
    private $description;
    private $status;
    private $is_system;
    private $permissions;

    function __construct() {
        
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getCode() {
        return $this->code;
    }

    function getDescription() {
        return $this->description;
    }

    function getStatus() {
        return $this->status;
    }

    function getIs_system() {
        return $this->is_system;
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

    function setCode($code) {
        $this->code = $code;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setIs_system($is_system) {
        $this->is_system = $is_system;
    }

    function setPermissions(PermissionResponse $permissions) {
        $this->permissions = $permissions;
    }

    public function toJson() {
        return \GuzzleHttp\json_encode($this->toString());
    }

    public function toString() {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'is_system' => $this->is_system,
            'permissions' => $this->permissions,
        ];
    }

}
