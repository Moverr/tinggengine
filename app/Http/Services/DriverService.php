<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

use App\Driver;
use App\Http\Controllers\RequestEntities\DealerRequest;
use App\Http\Controllers\RequestEntities\DriverRequest;
use App\Http\Controllers\RequestEntities\ProfileRequest;
use App\Http\Controllers\RequestEntities\UserRequest;
use App\Http\Controllers\ResponseEntities\DriverResponse;
use App\Http\Helpers\Utils;
use App\Http\Services\UserService;
use Exception;
use ProductCategories;
use App\Http\Services\DealerService;

/**
 * Description of StockistService
 *
 * @author mover  
 */
class DriverService {

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
            self::$instance = new DriverService();
        }
        return self::$instance;
    }

    public function getList($offset, $limit, $autneticaton_response = null) {
        $drivers = Driver::offset($offset)->limit($limit)->orderBy('date_created', 'desc')->get();
        $driverResponse = [];

        foreach ($drivers as $record) {
            $driverResponse [] = $this->populate($record)->toString();
        }

        return $driverResponse;
    }

    public function get($id, $autneticaton_response = null) {
        $drivers = Driver::where('id', $id)->get();
        if ($drivers == null || count($drivers) == 0) {
            throw new Exception("Record does not exist in the daabase", 403);
        }

        $driverResponse = $this->populate($drivers[0]);
        return $driverResponse->toString();
    }

    public function checkrefence($reference_id, $autneticaton_response = null) {
        $stockists = Driver::where('reference_id', $reference_id)->get();

        if ($stockists == null || count($stockists) == 0) {
            throw new Exception("Driver Reference does not exist in the daabase", 403);
        }

        $stockistReference = $this->populate($stockists[0]);
        return $stockistReference->toString();
    }

    public function save($request, $autneticaton_response = null) {
        $createdBy = $autneticaton_response->getId();

        if (!isset($request['dealer_reference'])) {
            throw new Exception("Dealer Reference is mandatory", 403);
        }

        $dealer_refernece = $request['dealer_reference'];
        $dealer = DealerService::getInstance()->checkrefence($dealer_refernece);
        $dealer_id = $dealer['id'];




        $names = $request['names'];
        $companyname = $request['companyname'];
        $joindate = $request['joindate'];
        $phonenumber = $request['phonenumber'];
        $countrycode = $request['countrcode'];

        $dealerRequest = new DriverRequest();
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
        $dealerRequest->setDealer_id($dealer_id);
       

        //populate user request
        $clientPassword = ("client123");
        $userRequest = new UserRequest();
        $userRequest->setPassword($clientPassword);
        $userRequest->setRepassword($clientPassword);
        $userRequest->setUsername($reference_id);
        $userRequest->setGroup('DRIVER');

        //populate profile request
        $profileRequest = new ProfileRequest();
        $profileRequest->setCompanyname($dealerRequest->getCompanyname());
        $profileRequest->setFirstname($dealerRequest->getFirstname());
        $profileRequest->setLastname($dealerRequest->getLastname());



        //todo: validate 
        $dealerRequest->validate();


        //todo: check if there is a stockist with the same phone number
        $drivers = Driver::where('phone_number', $phonenumber)->get();

        if (count($drivers) > 0) {
            throw new Exception("Driver exists in the database with same phone number ", 403);
        }


        //todo:  save stockist 
        $driver = $this->saveDriver($dealerRequest, $autneticaton_response);

        //todo: create user :: 
        $user = $this->userService->saveUser($userRequest, $autneticaton_response);


        //update profile
        $driver->user_id = $user->id;
        $driver->update();


        //save profile
        $profiles = $this->profileServie->saveProfile($profileRequest, $autneticaton_response);

        $user->profile_id = $profiles->id;
        $user->update();

        $dealerResponse = $this->populate($driver);

        return $dealerResponse->toString();
    }

    public function saveDriver(DriverRequest $driverRequest, $autneticaton_response = null) {

        $createdBy = $autneticaton_response->getId();


        $driver = new Driver();
        $driver->reference_id = $driverRequest->getReference_id();
        $driver->join_date = $driverRequest->getJoindate();
        $driver->user_id = 1;
        $driver->country_code = $driverRequest->getCountrycode();
        $driver->phone_number = $driverRequest->getPhonenumber();
        $driver->created_by = $createdBy;
        $driver->status = 'ACTIVE';
        $driver->dealer_id = $driverRequest->getDealer_id();
        $driver->save();

        return $driver;
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
            if (isset($namearray[1])) {
                $dealerRequest->setLastname($namearray[1]);
            }
        }

        $dealerRequest->setCountrycode($countrycode);
        $dealerRequest->setPhonenumber($phonenumber);
        $dealerRequest->setCompanyname($companyname);


        if ($request['id'] == null) {
            throw new Exception("Mandatory field ID is missing", 403);
        }

        $dealerRequest->setId($request['id']);
        $dealerRequest->validate();

        $dealer = Driver::where('id', $dealerRequest->getId())->first();
        if ($dealer == null) {
            throw new Exception("Record does not exist in the daabase", 403);
        }


        $profile = $dealer->User->profile;

//        $stockist->reference_id = $this->util->incrementalHash();
        $dealer->join_date = $dealerRequest->getJoindate();
//        $stockist->user_id = 1;
        $dealer->country_code = $dealerRequest->getCountrycode();
        $dealer->phone_number = $dealerRequest->getPhonenumber();

        $dealer->join_date = $joindate;
//        $stockist->id = $request['id'];
        $dealer->updated_by = $updatedBy;

        $dealer->update();



        if ($profile != null) {

            $profile->firstname = $dealerRequest->getFirstname();
            $profile->lastname = $dealerRequest->getLastname();
            $profile->companyname = $dealerRequest->getCompanyname();
            $profile->update();
        }




        $dealerResponse = $this->populate($dealer);
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
        $response = new DriverResponse();
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
