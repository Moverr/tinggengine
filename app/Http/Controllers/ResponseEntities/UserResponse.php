<?php

namespace App\Http\Controllers\ResponseEntities;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserResponse
 *
 * @author mover  
 */
class UserResponse {

    //put your code here
    private $id;
    private $username;
    private $role;
    private $dateCreated;
    private $author;
    private $datUpdated;
    private $profile;

    function __construct() {
        
    }

    function getId() {
        return $this->id;
    }

    function getUsername() {
        return $this->username;
    }

    function getRole() {
        return $this->role;
    }

    function getDateCreated() {
        return $this->dateCreated;
    }

    function getAuthor() {
        return $this->author;
    }

    function getDatUpdated() {
        return $this->datUpdated;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setRole($role) {
        $this->role = $role;
    }

    function setDateCreated($dateCreated) {
        $this->dateCreated = $dateCreated;
    }

    function setAuthor($author) {
        $this->author = $author;
    }

    function setDatUpdated($datUpdated) {
        $this->datUpdated = $datUpdated;
    }

    function getProfile() {
        return $this->profile;
    }

    function setProfile($profile) {
        $this->profile = $profile;
    }

    public function toJson() {
        return \GuzzleHttp\json_encode( $this->toString());
    }
    
     public function toString() {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'roles' => $this->role,
            'profile' => $this->profile,
            'dateCreated' => $this->dateCreated,
            'author' => $this->author
        ];
    }
    

}
