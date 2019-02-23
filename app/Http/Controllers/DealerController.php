<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Utils;
use App\Http\Services\DealerService;
use Illuminate\Http\Request;

class DealerController extends Controller {

    private $util;
    private $dealerService;

    function __construct() {
        $this->util = new Utils();
        $this->dealerService = DealerService::getInstance();
        
    }

    public function index(Request $request, $offset = 0, $limit = 10) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);
        return $this->dealerService->getList($offset, $limit);
    }

    public function get(Request $request, $id) {

        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        return $this->dealerService->get($id);
    }

    public function checkrefence(Request $request, $reference_id) {

        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        return $this->dealerService->checkrefence($reference_id);
    }

    public function save(Request $request) {

        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);
        return $this->dealerService->save($request, $autneticaton_response);
    }

    public function update(Request $request) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);
        return $this->dealerService->update($request,$autneticaton_response);
    }

    public function archive(Request $request, $id) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);
        $this->dealerService->archive($id);
    }

}
