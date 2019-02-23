<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\Utils;
 use App\Http\Services\DriverService;

class DriverController extends Controller {

    private $util;
    private $driverService;

    function __construct() {
        $this->util = new Utils();
        $this->driverService = DriverService::getInstance();
        
    }

    public function index(Request $request, $offset = 0, $limit = 10) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);
        return $this->driverService->getList($offset, $limit);
    }

    public function get(Request $request, $id) {

        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        return $this->driverService->get($id);
    }

    public function checkrefence(Request $request, $reference_id) {

        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        return $this->driverService->checkrefence($reference_id);
    }

    public function save(Request $request) {

        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);
        return $this->driverService->save($request, $autneticaton_response);
    }

    public function update(Request $request) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);
        return $this->driverService->update($request,$autneticaton_response);
    }

    public function archive(Request $request, $id) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);
        $this->driverService->archive($id);
    }

}
