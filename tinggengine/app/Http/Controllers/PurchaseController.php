<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\Utils;
use App\Stock;
use App\Http\Controllers\RequestEntities\StockRequest;
use App\Stock;

class PurchaseController extends Controller {

    private $util;

    function __construct() {
        $this->util = new Utils();
    }

    public function index(Request $request, $offset = 0, $limit = 10) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        $stock = Stock::offset($offset)->limit($limit)->get();
        return json_encode($stock);
    }

    public function get(Request $request, $id) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        $stock = Products::where('id', $id)->get();
        if ($stock == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Record does not exist in the daabase");
        }

        $productResponse = $this->populate($stock);
        return $productResponse->toJson();
    }

    public function save(Request $request) {
        
    }

    public function update(Request $request) {
        
    }

    public function archive(Request $request, $id) {
        
    }

}
