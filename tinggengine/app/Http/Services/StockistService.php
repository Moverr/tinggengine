<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use App\Http\Helpers\Utils;
use App\Http\Controllers\ResponseEntities\StockistResponse;
use App\Http\Controllers\RequestEntities\StockistRequest;
use App\Stockists;
use App\User;

namespace App\Http\Services;

/**
 * Description of StockistService
 *
 * @author mover  
 */
class StockistService {

    //put your code here
    private $util;
    private static $instance;

    function __construct() {
        $this->util = new Utils();
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new StockistService();
        }
        return self::$instance;
    }

    public function getList($offset, $limit, $autneticaton_response = null) {
        $stockists = Stockists::offset($offset)->limit($limit)->get();
        $stockistReference = [];

        foreach ($stockists as $record) {
            $stockistReference [] = $this->populate($record)->toJson();
        }

        return $stockistReference;
    }

    public function get($id, $autneticaton_response = null) {
        $stockists = Stockists::where('id', $id)->get();
        if ($stockists == null || count($stockists) == 0) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Record does not exist in the daabase");
        }

        $stockistReference = $this->populate($stockists[0]);
        return $stockistReference->toJson();
    }

    public function checkrefence($reference_id, $autneticaton_response = null) {
        $stockists = Stockists::where('reference_id', $reference_id)->get();

        if ($stockists == null || count($stockists) == 0) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Record does not exist in the daabase");
        }

        $stockistReference = $this->populate($stockists[0]);
        return $stockistReference->toJson();
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
            $namearray = split(" ", $names);
            $stockistRequest->setFirstname($namearray[0]);
            $stockistRequest->setLastname($namearray[1]);
        }

        $stockistRequest->setCountrycode($countrycode);
        $stockistRequest->setPhonenumber($phonenumber);
        $stockistRequest->setCompanyname($companyname);

        //todo: validate 
        $stockistRequest->validate();

        //todo: check if there is a stockist with the same phone number
        $stockists = Stockists::where('phone_number', $phonenumber)->get();

        if (count($stockists) > 0) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Stockists exists in the database with same phone number ");
        }

        //todo:  validate the request
        $stockist = new Stockists();
        $stockist->reference_id = $this->util->incrementalHash();
        $stockist->join_date = $stockistRequest->getJoindate();
        $stockist->user_id = 1;
        $stockist->country_code = $stockistRequest->getCountrycode();
        $stockist->phone_number = $stockistRequest->getPhonenumber();
        $stockist->created_by = $createdBy;
        $stockist->status = 'ACTIVE';
        $stockist->join_date = $joindate;
        $stockist->save();

        //todo: create user :: 
        $user = new User();
        $user->username = $phonenumber;
        $user->password = Utils::HashPassword("client123");
        $user->status = 'ACTIVE';
        $user->save();


        $stockist->user_id = $user->id;
        $stockist->update();

        $stockistResponse = $this->populate($stockist);

        return $stockistResponse->toJson();
    }

    public function update($request, $authentication = null) {

        $updatedBy = $autneticaton_response->getId();


        $names = $request['names'];
        $companyname = $request['companyname'];
        $joindate = $request['joindate'];
        $phonenumber = $request['phonenumber'];
        $countrycode = $request['countrcode'];

        $stockistRequest = new StockistRequest();
        if ($names != null) {
            $namearray = split(" ", $names);
            $stockistRequest->setFirstname($namearray[0]);
            $stockistRequest->setLastname($namearray[1]);
        }

        $stockistRequest->setCountrycode($countrycode);
        $stockistRequest->setPhonenumber($phonenumber);
        $stockistRequest->setCompanyname($companyname);


        if ($request['id'] == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Mandatory field ID is missing");
        }

        $stockistRequest->setId($request['id']);
        $stockistRequest->validate();

        $stockist = Stockists::where('id', $stockistRequest->getId())->first();
        if ($stockist == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Record does not exist in the daabase");
        }



        $stockist->reference_id = $this->util->incrementalHash();
        $stockist->join_date = $stockistRequest->getJoindate();
        $stockist->user_id = 1;
        $stockist->country_code = $stockistRequest->getCountrycode();
        $stockist->phone_number = $stockistRequest->getPhonenumber();

        $stockist->join_date = $joindate;
        $stockist->id = $request['id'];
        $stockist->updated_by = $updatedBy;

        $stockist->update();

        $stockistResponse = $this->populate($stockist);
        return $stockistResponse->toJson();
    }

    public function archive($id, $autneticaton_response = null) {

        $product = ProductCategories::where('id', $id)->first();
        if ($product == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Record does not exist in the daabase");
        }
        $product->status = 'ARCHIVED';
        $product->update();
    }

    public function populate($stockist) {
        $response = new StockistResponse();
        $response->setId($stockist->id);
        //todo : we shall overcome
        $response->setReference_id($stockist->reference_id);
        $response->setCountrycode($stockist->countrycode);
        $response->setPhonenumber($stockist->phone_number);
        $response->setCreatedBy($stockist->created_by);
        $response->setStatus($stockist->status);
        $response->setJoindate($stockist->join_date);
        $response->setDatecreated($stockist->date_created);

        return $response;
    }

}
