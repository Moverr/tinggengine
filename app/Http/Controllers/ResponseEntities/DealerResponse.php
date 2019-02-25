<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\ResponseEntities;

/**
 * Description of StockistResponse
 *
 * @author mover  
 */
class DealerResponse {

    private $id;
    private $firstname;
    private $lastname;
    private $companyname;
    private $reference_id;
    private $countrycode;
    private $phonenumber;
    private $joindate;
    private $status;
    private $datecreated;
    private $createdBy;

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

    function getReference_id() {
        return $this->reference_id;
    }

    function getCountrycode() {
        return $this->countrycode;
    }

    function getPhonenumber() {
        return $this->phonenumber;
    }

    function getJoindate() {
        return $this->joindate;
    }

    function getStatus() {
        return $this->status;
    }

    function getDatecreated() {
        return $this->datecreated;
    }

    function getCreatedBy() {
        return $this->createdBy;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    function setCompanyname($companyname) {
        $this->companyname = $companyname;
    }

    function setReference_id($reference_id) {
        $this->reference_id = $reference_id;
    }

    function setCountrycode($countrycode) {
        $this->countrycode = $countrycode;
    }

    function setPhonenumber($phonenumber) {
        $this->phonenumber = $phonenumber;
    }

    function setJoindate($joindate) {
        $this->joindate = $joindate;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setDatecreated($datecreated) {
        $this->datecreated = $datecreated;
    }

    function setCreatedBy($createdBy) {
        $this->createdBy = $createdBy;
    }

    public function toJson() {
        return \GuzzleHttp\json_encode($this->toString());
    }

    public function toString() {
        return ([
            'id' => $this->id,
            'name' => $this->firstname . ' ' . $this->lastname,
            'countrycode' => $this->countrycode,
            'phonenuber' => $this->phonenumber,
            'bussiness' => $this->companyname,
            'reference_id' => $this->reference_id,
            'joindate' => $this->joindate,
            'createdBy' => $this->createdBy,
            'date_created' => $this->datecreated
        ]);
    }

}
