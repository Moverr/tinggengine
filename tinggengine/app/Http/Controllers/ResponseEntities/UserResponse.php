<?php

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
    private $author_id;
    private $datUpdated;

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

    function getAuthor_id() {
        return $this->author_id;
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

    function setAuthor_id($author_id) {
        $this->author_id = $author_id;
    }

    function setDatUpdated($datUpdated) {
        $this->datUpdated = $datUpdated;
    }

}
