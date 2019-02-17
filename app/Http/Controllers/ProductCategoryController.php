<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\Utils;
use App\Http\Services\ProductCategoryService;

class ProductCategoryController extends Controller {

    private $util;
    private $productcategoryservice;

    function __construct() {
        $this->util = new Utils();
        $this->productcategoryservice = ProductCategoryService::getInstance();
    }

    public function index(Request $request, $offset = 0, $limit = 10) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);
        return $this->productcategoryservice->getList($offset, $limit);
    }

    public function get(Request $request, $id) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        return $this->productcategoryservice->get($id);
    }

    public function save(Request $request) {

        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);
        return $this->productcategoryservice->save($request, $autneticaton_response);
    }

    public function update(Request $request) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        return $this->productcategoryservice->update($request);
    }

    public function archive(Request $request, $id) {

        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);
        $this->productcategoryservice->archive($id);
    }

}
