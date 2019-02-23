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
use App\Http\Controllers\ResponseEntities\StockistResponse;
use App\Http\Helpers\Utils;
use App\Http\Services\UserService;
use App\Stockists;
use Exception;
use ProductCategories;

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
        $stockists = Stockists::offset($offset)->limit($limit)->orderBy('date_created', 'desc')->get();
        $stockistReference = [];

        foreach ($stockists as $record) {
            $stockistReference [] = $this->populate($record)->toString();
        }

        return $stockistReference;
    }

    public function get($id, $autneticaton_response = null) {
        $stockists = Stockists::where('id', $id)->get();
        if ($stockists == null || count($stockists) == 0) {
            throw new Exception("Record does not exist in the daabase", 403);
        }

        $stockistReference = $this->populate($stockists[0]);
        return $stockistReference->toString();
    }

    public function checkrefence($reference_id, $autneticaton_response = null) {
        $stockists = Stockists::where('reference_id', $reference_id)->get();

        if ($stockists == null || count($stockists) == 0) {
            throw new Exception("Stockist Reference does not exist in the daabase", 403);
        }

        $stockistReference = $this->populate($stockists[0]);
        return $stockistReference->toString();
    }

    public function save($request, $autneticaton_response = null) {
        $createdBy = $autneticaton_response->getId();


        $names = $request['names'];
        $companyname = $request['companyname'];
        $joindate = $request['joindate'];
        $phonenumber = $request['phonenumber'];
        $countrycode = $request['countrcode'];

        $stockistRequest = new StockistRequest();
        if ($names != null) {
            $namearray = explode(" ", $names);
            $stockistRequest->setFirstname($namearray[0]);
            if (isset($namearray[1])) {
                $stockistRequest->setLastname($namearray[1]);
            }
        }

        $reference_id = $this->util->incrementalHash();

        //populate stockist request
        $stockistRequest->setCountrycode($countrycode);
        $stockistRequest->setPhonenumber($phonenumber);
        $stockistRequest->setCompanyname($companyname);
        $stockistRequest->setReference_id($reference_id);
        $stockistRequest->setJoindate($joindate);

        //populate user request
        $clientPassword = ("client123");
        $userRequest = new UserRequest();
        $userRequest->setPassword($clientPassword);
        $userRequest->setRepassword($clientPassword);
        $userRequest->setUsername($reference_id);
        $userRequest->setGroup('STOCKIST');

        //populate profile request
        $profileRequest = new ProfileRequest();
        $profileRequest->setCompanyname($stockistRequest->getCompanyname());
        $profileRequest->setFirstname($stockistRequest->getFirstname());
        $profileRequest->setLastname($stockistRequest->getLastname());



        //todo: validate 
        $stockistRequest->validate();


        //todo: check if there is a stockist with the same phone number
        $stockists = Stockists::where('phone_number', $phonenumber)->get();

        if (count($stockists) > 0) {
            throw new Exception("Stockists exists in the database with same phone number ", 403);
        }


        //todo:  save stockist 
        $stockist = $this->saveStockist($stockistRequest, $autneticaton_response);

        //todo: create user :: 
        $user = $this->userService->saveUser($userRequest, $autneticaton_response);


        //update profile
        $stockist->user_id = $user->id;
        $stockist->update();


        //save profile
        $profiles = $this->profileServie->saveProfile($profileRequest, $autneticaton_response);

        $user->profile_id = $profiles->id;
        $user->update();

        $stockistResponse = $this->populate($stockist);

        return $stockistResponse->toString();
    }

    public function saveStockist(StockistRequest $stockistRequest, $autneticaton_response = null) {

        $createdBy = $autneticaton_response->getId();


        $stockist = new Stockists();
        $stockist->reference_id = $stockistRequest->getReference_id();
        $stockist->join_date = $stockistRequest->getJoindate();
        $stockist->user_id = 1;
        $stockist->country_code = $stockistRequest->getCountrycode();
        $stockist->phone_number = $stockistRequest->getPhonenumber();
        $stockist->created_by = $createdBy;
        $stockist->status = 'ACTIVE';
        $stockist->save();

        return $stockist;
    }

    public function update($request, $authentication = null) {

        $updatedBy = $authentication->getId();


        $names = $request['names'];
        $companyname = $request['companyname'];
        $joindate = $request['joindate'];
        $phonenumber = $request['phonenumber'];
        $countrycode = $request['countrcode'];

        $stockistRequest = new StockistRequest();
        if ($names != null) {
            $namearray = explode(" ", $names);
            $stockistRequest->setFirstname($namearray[0]);
            if (isset($namearray[1]))
                $stockistRequest->setLastname($namearray[1]);
        }

        $stockistRequest->setCountrycode($countrycode);
        $stockistRequest->setPhonenumber($phonenumber);
        $stockistRequest->setCompanyname($companyname);


        if ($request['id'] == null) {
            throw new Exception("Mandatory field ID is missing", 403);
        }

        $stockistRequest->setId($request['id']);
        $stockistRequest->validate();

        $stockist = Stockists::where('id', $stockistRequest->getId())->first();
        if ($stockist == null) {
            throw new Exception("Record does not exist in the daabase", 403);
        }


        $profile = $stockist->User->profile;

//        $stockist->reference_id = $this->util->incrementalHash();
        $stockist->join_date = $stockistRequest->getJoindate();
//        $stockist->user_id = 1;
        $stockist->country_code = $stockistRequest->getCountrycode();
        $stockist->phone_number = $stockistRequest->getPhonenumber();

        $stockist->join_date = $joindate;
//        $stockist->id = $request['id'];
        $stockist->updated_by = $updatedBy;

        $stockist->update();



        if ($profile != null) {

            $profile->firstname = $stockistRequest->getFirstname();
            $profile->lastname = $stockistRequest->getLastname();
            $profile->companyname = $stockistRequest->getCompanyname();
            $profile->update();
        }




        $stockistResponse = $this->populate($stockist);
        return $stockistResponse->toString();
    }

    public function archive($id, $autneticaton_response = null) {

        $product = ProductCategories::where('id', $id)->first();
        if ($product == null) {
            throw new Exception("Record does not exist in the daabase", 403);
        }
        $product->status = 'ARCHIVED';
        $product->update();
    }

    public function populate($stockist) {
        $response = new StockistResponse();
        $response->setId($stockist->id);
        $response->setFirstname($stockist->User->profile['firstname']);
        $response->setLastname($stockist->User->profile['lastname']);
        $response->setCompanyname($stockist->User->profile['companyname']);
        $response->setReference_id($stockist->reference_id);
        $response->setCountrycode($stockist->country_code);
        $response->setPhonenumber($stockist->phone_number);
        $response->setCreatedBy($stockist->Author->username);
        $response->setStatus($stockist->status);
        $response->setJoindate($stockist->join_date);
        $response->setDatecreated($this->util->convertToTimestamp($stockist->date_created));

        return $response;
    }

}
