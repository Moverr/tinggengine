<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\ResponseEntities;

/**
 * Description of ProfileResponse
 *
 * @author mover  
 */
class ProfileResponse {

    //put your code here

    private $id;
    private $firstname;
    private $lastname;
    private $companyname;
    private $status;

    function __construct() {
        
    }

    function getId() {
        return $this->id;
    }

    function getFirstname() {
        return $this->firstname;
    }

    function getLastname() {
        return $this->lastname;
    }

    function getCompanyname() {
        return $this->companyname;
    }

    function getStatus() {
        return $this->status;
    }

    function setId($id) {
        $this->id = $id;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    function setCompanyname($companyname) {
        $this->companyname = $companyname;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    public function toJson() {
        return \GuzzleHttp\json_encode([
            'id' => $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'companyname' => $this->companyname,
            'status' => $this->status
        ]);
    }

}
