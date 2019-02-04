<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\Utils;
use App\ProductCategories;
use App\Http\Controllers\ResponseEntities\ProductResponse;

class ProductCategoryController extends Controller {

    private $util;

    function __construct() {
        $this->util = new Utils();
    }

    public function index(Request $request, $offset = 0, $limit = 10) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        $productCategories = ProductCategories::offset($offset)->limit($limit)->get();
        return json_encode($productCategories);
    }

    public function get(Request $request, $id) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        $productCategories = ProductCategories::where('id', $id)->get();
        if ($productCategories == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Record does not exist in the daabase");
        }


        
        $productResponse = new ProductResponse();
        $productResponse->setId($productCategories[0]->id);
        $productResponse->setCreatedBy(null);
        $productResponse->setCategory("N/A");
        $productResponse->setName($productCategories[0]->name);
        $productResponse->setCode($productCategories[0]->code);
        $productResponse->setDateCreated("N/A");
        return $productResponse->toJson();
    }

    public function save(Request $request) {
        
    }

    public function update(Request $request) {
        
    }

    public function archive(Request $request, $id) {
        
    }

}
