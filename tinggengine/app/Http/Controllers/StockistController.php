<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\Utils;
use App\Http\Controllers\ResponseEntities\StockistResponse;
use App\Http\Controllers\RequestEntities\StockistRequest;
use App\Stockists;

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


        $names = $request['names'];
        $companyname = $request['companyname'];
        $joindate = $request['joindate'];
        $phonenumber = $request['phonenumber'];
        $countrycode = $request['countrcode'];

        //---- 
        $stockistRequest = new StockistRequest();
        if ($names != null) {
            $namearray = split(" ", $names);
            $stockistRequest->setFirstname($namearray[0]);
            $stockistRequest->setLastname($namearray[1]);
            $stockistRequest->setCountrycode($countrycode);
            $stockistRequest->setPhonenumber($phonenumber);
        }



        //todo:  validate the request
        //todo: create user  
        //todo: create stocist:. if username exist with the same name, and there is non :: stockist with the same phone number
        //create one  and move ::
        //todo: create a 



        $reference_id = "refrence_id";
        $quantity = $request['quantity'];
        $unit_selling_price = $request['unit_selling_price'];
        $unit_purchase_price = $request['unit_purchase_price'];
        $unit_measure = $request['unit_measure'];
        $createdBy = $autneticaton_response->getId();
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
