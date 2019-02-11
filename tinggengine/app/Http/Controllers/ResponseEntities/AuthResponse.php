<?php

namespace App\Http\Controllers\ResponseEntities;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AuthenticationResponse
 *
 * @author mover  
 */
class AuthResponse {

    //put your code here
    private $id;
    private $authentication;
    private $role_id;

    function __construct() {
        
    }

    function getId() {
        return $this->id;
    }

    function getAuthentication() {
        return $this->authentication;
    }

    function getRoleId() {
        return $this->role_id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setAuthentication($authentication) {
        $this->authentication = $authentication;
    }

    function setRoleId($role_id) {
        $this->role_id = $role_id;
    }

    public function toJson() {
        return \GuzzleHttp\json_encode($this->toString());
    }

    public function toString() {
        return [
            'id' => $this->id,
            'authentication' => $this->authentication,
            'role_id' => $this->role_id
        ];
    }

}
