<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\Utils;
use App\Http\Controllers\ResponseEntities\PurchaseOrderResponse;
use App\Http\Services\PurchaseService;

class PurchaseController extends Controller {

    private $util;
    private $purchaseService;

    function __construct() {
        $this->util = new Utils();
        $this->purchaseService = PurchaseService::getInstance();
    }

    public function index(Request $request, $offset = 0, $limit = 10) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);
        return $this->purchaseService->getList($offset, $limit);
    }

    public function get(Request $request, $id) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);
        return $this->purchaseService->get($id,$autneticaton_response);
    }

    public function save(Request $request) {

        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        return $this->purchaseService->save($request,$autneticaton_response);
    }

    public function update(Request $request) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        return $this->purchaseService->update($request);
    }

    public function archive(Request $request, $id) {

        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        return $this->purchaseService->update($id);
    }

}
