<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\Utils;
use App\Http\Controllers\ResponseEntities\StockistResponse;
use App\Http\Controllers\RequestEntities\StockistRequest;
use App\Stockists;
use App\User;

class StockistController extends Controller {

    private $util;

    function __construct() {
        $this->util = new Utils();
    }

    public function index(Request $request, $offset = 0, $limit = 10) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);
        $stockists = Stockists::offset($offset)->limit($limit)->get();
        $stockistReference = [];

        foreach ($stockists as $record) {
            $stockistReference [] = $this->populate($record)->toJson();
        }

        return $stockistReference;
    }

    public function get(Request $request, $id) {

        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        $stockists = Stockists::where('id', $id)->get();
        if ($stockists == null || count($stockists) == 0) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Record does not exist in the daabase");
        }

        $stockistReference = $this->populate($stockists[0]);
        return $stockistReference->toJson();
    }

    public function checkrefence(Request $request, $reference_id) {

        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        $stockists = Stockists::where('reference_id', $reference_id)->get();

        if ($stockists == null || count($stockists) == 0) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Record does not exist in the daabase");
        }

        $stockistReference = $this->populate($stockists[0]);
        return $stockistReference->toJson();
    }

    public function save(Request $request) {

        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);
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

        //todo: create user :: 
        $user = new User();
        $user->username = $phonenumber;
        $user->password = Utils::HashPassword("client123");
        $user->status = 'ACTIVE';
        $user->save();

        //todo:  validate the request
        $stockist = new Stockists();
        $stockist->reference_id = $this->util->incrementalHash();
        $stockist->join_date = $stockistRequest->getJoindate();
        $stockist->user_id = $user->id;
        $stockist->country_code = $stockistRequest->getCountrycode();
        $stockist->phone_number = $stockistRequest->getPhonenumber();
        $stockist->created_by = $createdBy;
        $stockist->status = 'ACTIVE';
        $stockist->join_date = $joindate;
        $stockist->save();


        //todo: response: the missing link is the profile ::
        $stockitResponse = new StockistResponse();
        $stockitResponse->setCompanyname($companyname);
        $stockitResponse->setCountrycode($countrycode);
        $stockitResponse->setPhonenumber($phonenumber);
        $stockitResponse->$stockist->reference_id;


        return $stockitResponse->toJson();
    }

    public function update(Request $request) {
        
    }

    public function archive(Request $request, $id) {
        
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
