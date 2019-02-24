<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

use App\Http\Controllers\RequestEntities\ProfileRequest;
use App\Http\Controllers\RequestEntities\StockistRequest;
use App\Http\Controllers\RequestEntities\UserRequest; 
use App\Http\Helpers\Utils;
use App\Http\Services\UserService;
 
use Exception;
use ProductCategories;
use App\Http\Controllers\RequestEntities\DealerRequest;
use App\Http\Controllers\ResponseEntities\DealerResponse;
use App\Dealer;

/**
 * Description of StockistService
 *
 * @author mover  
 */
class DealerService {

    //put your code here
    private $util;
    private static $instance;
    private $userService;
    private $profileServie;

    function __construct() {
        $this->util = new Utils();
        $this->userService = UserService::getInstance();
        $this->profileServie = ProfileService::getInstance();
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new DealerService();
        }
        return self::$instance;
    }

    public function getList($offset, $limit, $autneticaton_response = null) {
        $dealers = Dealer::offset($offset)->limit($limit)->orderBy('date_created', 'desc')->get();
        $dealerResponses = [];

        foreach ($dealers as $record) {
            $dealerResponses [] = $this->populate($record)->toString();
        }

        return $dealerResponses;
    }

    public function get($id, $autneticaton_response = null) {
        $dealers = Dealer::where('id', $id)->get();
        if ($dealers == null || count($dealers) == 0) {
            throw new Exception("Record does not exist in the daabase", 403);
        }

        $dealerResponse = $this->populate($dealers[0]);
        return $dealerResponse->toString();
    }

    public function checkrefence($reference_id, $autneticaton_response = null) {
        $dealers = Dealer::where('reference_id', $reference_id)->get();

        if ($dealers == null || count($dealers) == 0) {
            throw new Exception("Stockist Reference does not exist in the daabase", 403);
        }

        $dealerResponse = $this->populate($dealers[0]);
        return $dealerResponse->toString();
    }

    public function save($request, $autneticaton_response = null) {
        $createdBy = $autneticaton_response->getId();


        $names = $request['names'];
        $companyname = $request['companyname'];
        $joindate = $request['joindate'];
        $phonenumber = $request['phonenumber'];
        $countrycode = $request['countrcode'];

        $dealerRequest = new DealerRequest();
        if ($names != null) {
            $namearray = explode(" ", $names);
            $dealerRequest->setFirstname($namearray[0]);
            if (isset($namearray[1])) {
                $dealerRequest->setLastname($namearray[1]);
            }
        }

        $reference_id = $this->util->incrementalHash();

        //populate stockist request
        $dealerRequest->setCountrycode($countrycode);
        $dealerRequest->setPhonenumber($phonenumber);
        $dealerRequest->setCompanyname($companyname);
        $dealerRequest->setReference_id($reference_id);
        $dealerRequest->setJoindate($joindate);

        //populate user request
        $clientPassword = ("client123");
        $userRequest = new UserRequest();
        $userRequest->setPassword($clientPassword);
        $userRequest->setRepassword($clientPassword);
        $userRequest->setUsername($reference_id);
        $userRequest->setGroup('DEALER');

        //populate profile request
        $profileRequest = new ProfileRequest();
        $profileRequest->setCompanyname($dealerRequest->getCompanyname());
        $profileRequest->setFirstname($dealerRequest->getFirstname());
        $profileRequest->setLastname($dealerRequest->getLastname());



        //todo: validate 
        $dealerRequest->validate();


        //todo: check if there is a stockist with the same phone number
        $stockists = Dealer::where('phone_number', $phonenumber)->get();

        if (count($stockists) > 0) {
            throw new Exception("Dealer exists in the database with same phone number ", 403);
        }


        //todo:  save stockist 
        $stockist = $this->saveDealer($dealerRequest, $autneticaton_response);

        //todo: create user :: 
        $user = $this->userService->saveUser($userRequest, $autneticaton_response);


        //update profile
        $stockist->user_id = $user->id;
        $stockist->update();


        //save profile
        $profiles = $this->profileServie->saveProfile($profileRequest, $autneticaton_response);

        $user->profile_id = $profiles->id;
        $user->update();

        $dealerResponse = $this->populate($stockist);

        return $dealerResponse->toString();
    }

    public function saveDealer(DealerRequest $dealerRequest, $autneticaton_response = null) {

        $createdBy = $autneticaton_response->getId();


        $dealer = new Dealer();
        $dealer->reference_id = $dealerRequest->getReference_id();
        $dealer->join_date = $dealerRequest->getJoindate();
        $dealer->user_id = 1;
        $dealer->country_code = $dealerRequest->getCountrycode();
        $dealer->phone_number = $dealerRequest->getPhonenumber();
        $dealer->created_by = $createdBy;
        $dealer->status = 'ACTIVE';
        $dealer->save();

        return $dealer;
    }

    public function update($request, $authentication = null) {

        $updatedBy = $authentication->getId();


        $names = $request['names'];
        $companyname = $request['companyname'];
        $joindate = $request['joindate'];
        $phonenumber = $request['phonenumber'];
        $countrycode = $request['countrcode'];

        $dealerRequest = new DealerRequest();
        if ($names != null) {
            $namearray = explode(" ", $names);
            $dealerRequest->setFirstname($namearray[0]);
            if (isset($namearray[1]))
                $dealerRequest->setLastname($namearray[1]);
        }

        $dealerRequest->setCountrycode($countrycode);
        $dealerRequest->setPhonenumber($phonenumber);
        $dealerRequest->setCompanyname($companyname);


        if ($request['id'] == null) {
            throw new Exception("Mandatory field ID is missing", 403);
        }

        $dealerRequest->setId($request['id']);
        $dealerRequest->validate();

        $stockist = Dealer::where('id', $dealerRequest->getId())->first();
        if ($stockist == null) {
            throw new Exception("Record does not exist in the daabase", 403);
        }


        $profile = $stockist->User->profile;

//        $stockist->reference_id = $this->util->incrementalHash();
        $stockist->join_date = $dealerRequest->getJoindate();
//        $stockist->user_id = 1;
        $stockist->country_code = $dealerRequest->getCountrycode();
        $stockist->phone_number = $dealerRequest->getPhonenumber();

        $stockist->join_date = $joindate;
//        $stockist->id = $request['id'];
        $stockist->updated_by = $updatedBy;

        $stockist->update();



        if ($profile != null) {

            $profile->firstname = $dealerRequest->getFirstname();
            $profile->lastname = $dealerRequest->getLastname();
            $profile->companyname = $dealerRequest->getCompanyname();
            $profile->update();
        }




        $dealerResponse = $this->populate($stockist);
        return $dealerResponse->toString();
    }

    public function archive($id, $autneticaton_response = null) {

        $product = ProductCategories::where('id', $id)->first();
        if ($product == null) {
            throw new Exception("Record does not exist in the daabase", 403);
        }
        $product->status = 'ARCHIVED';
        $product->update();
    }

    public function populate($dealer) {
        $response = new DealerResponse();
        $response->setId($dealer->id);
        $response->setFirstname($dealer->User->profile['firstname']);
        $response->setLastname($dealer->User->profile['lastname']);
        $response->setCompanyname($dealer->User->profile['companyname']);
        $response->setReference_id($dealer->reference_id);
        $response->setCountrycode($dealer->country_code);
        $response->setPhonenumber($dealer->phone_number);
        $response->setCreatedBy($dealer->Author->username);
        $response->setStatus($dealer->status);
        $response->setJoindate($dealer->join_date);
        $response->setDatecreated($this->util->convertToTimestamp($dealer->date_created));

        return $response;
    }

}
