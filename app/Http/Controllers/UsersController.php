<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Helpers\Utils;
use App\Http\Services\UserService;

class UsersController extends Controller {

    private $util;
    private $userservice;

    function __construct() {
        $this->util = new Utils();
        $this->userservice = UserService::getInstance();
    }

    public function index(Request $request, $offset = 0, $limit = 10) {


        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);
        return $this->userservice->getList($offset, $limit);
    }

    public function get(Request $request, $id) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);
        return $this->userservice->get($id);
    }

    public function login(Request $request) {
        return $this->userservice->login($request);
    }

    public function save(Request $request) {

        // $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);
        return $this->userservice->save($request, $autneticaton_response);
    }

    public function update(Request $request) {

        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        return $this->userservice->update($request);
    }

    public function archive(Request $request, $id) {


        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        $this->userservice->archive($id);
    }

}
