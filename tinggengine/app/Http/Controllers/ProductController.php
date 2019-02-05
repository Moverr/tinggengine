<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\Utils;
use App\Products;
use App\Http\Controllers\ResponseEntities\ProductResponse;

class ProductController extends Controller {

    private $util;

    function __construct() {
        $this->util = new Utils();
    }

    public function index(Request $request, $offset = 0, $limit = 10) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        $products = Products::offset($offset)->limit($limit)->get();
        return json_encode($products);
    }

    public function get(Request $request, $id) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        $products = Products::where('id', $id)->get();
        if ($products == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Record does not exist in the daabase");
        }

        $productResponse = $this->populate($products);
        return $productResponse->toJson();
    }

    public function save(Request $request) {
        
    }

    public function update(Request $request) {
        
    }

    public function archive(Request $request, $id) {
        
    }

    
     public function populate($products) {
        $productCategoryResponse = new ProductResponse();
        $productCategoryResponse->setId($products[0]->id);
        $productCategoryResponse->setCreatedBy(null);
        $productCategoryResponse->setCategory("N/A");
        $productCategoryResponse->setName($products[0]->name);
        $productCategoryResponse->setCode($products[0]->code);
        $productCategoryResponse->setDateCreated("N/A");
        return $productCategoryResponse;
    }
    
    
}
