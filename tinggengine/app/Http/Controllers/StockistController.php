<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\Utils;
use App\Stock;
use App\Http\Controllers\RequestEntities\StockRequest;
use App\Http\Controllers\ResponseEntities\StockResponse;
use App\Http\Controllers\ResponseEntities\StockistResponse;
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
        $productResponses = [];

        foreach ($stockists as $record) {
            $productResponses [] = $this->populate($record)->toJson();
        }

        return $productResponses;
    }

    public function get(Request $request, $id) {
        
    }

    public function save(Request $request) {
        
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
