<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\Utils;
use App\Stock;
use App\Http\Controllers\RequestEntities\StockRequest;
use App\Http\Controllers\ResponseEntities\StockResponse;
use App\StockTransactions;

class StockistController extends Controller {

    private $util;

    function __construct() {
        $this->util = new Utils();
    }

    public function index(Request $request, $offset = 0, $limit = 10) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);
        $stock = Stock::offset($offset)->limit($limit)->get();
        $productResponses = [];
        foreach ($stock as $record) {
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

}
