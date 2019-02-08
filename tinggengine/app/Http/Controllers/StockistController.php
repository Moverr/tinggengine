<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\Utils;
use App\Http\Controllers\ResponseEntities\StockistResponse;
use App\Http\Controllers\RequestEntities\StockistRequest;
use App\Stockists;
use App\User;
use App\Http\Services\StockistService;

class StockistController extends Controller {

    private $util;
    private $stockistservice;

    function __construct() {
        $this->util = new Utils();
        $this->stockistservice = new StockistService();
    }

    public function index(Request $request, $offset = 0, $limit = 10) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);
        return $this->stockistservice->getList($offset, $limit);
    }

    public function get(Request $request, $id) {

        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        return $this->stockistservice->get($id);
    }

    public function checkrefence(Request $request, $reference_id) {

        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        return $this->stockistservice->checkrefence($reference_id);
    }

    public function save(Request $request) {

        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);
        return $this->stockistservice->save($request, $autneticaton_response);
    }

    public function update(Request $request) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);
        return $this->stockistservice->update($request);
    }

    public function archive(Request $request, $id) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);
        $this->stockistservice->archive($id);
    }

}
