<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\Utils;
use App\Products;
use App\Http\Controllers\ResponseEntities\ProductResponse;
use App\Http\Controllers\RequestEntities\ProductRequest;

class ProductController extends Controller {

    private $util;

    function __construct() {
        $this->util = new Utils();
    }

    public function index(Request $request, $offset = 0, $limit = 10) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);
        $products = Products::offset($offset)->limit($limit)->get();

        $productResponses = [];
        foreach ($products as $record) {
            $productResponses [] = $this->populate($record)->toJson();
        }



        return ($productResponses);
    }

    public function get(Request $request, $id) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        $products = Products::where('id', $id)->get();
        if ($products == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Record does not exist in the daabase");
        }

        $productResponse = $this->populate($products[0]);
        return $productResponse->toJson();
    }

    public function save(Request $request) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        $name = $request['name'];
        $code = $request['code'];
        $categoryId = $request['categoryId'];
        $createdBy = $autneticaton_response->getId();


        $productCategoryRequest = new ProductRequest($name, $code, $categoryId);
        $productCategoryRequest->validate();

        //set the author of the system :: 
        $productCategoryRequest->setCreatedBy($createdBy);


        $products = Products::where('name', $name)
                ->where('code', $code)
                ->first();
        if ($products != null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Product   Exists with the same name or code in the database ");
        }

        $products = new Products();
        $products->name = $name;
        $products->code = $code;
        $products->category_id = $categoryId;
        $products->status = 'ACTIVE';
        $products->created_by = $createdBy;

        $products->save();

        $productResponse = $this->populate($products);
        return $productResponse->toJson();
    }

    public function update(Request $request) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        $name = $request['name'];
        $code = $request['code'];
        $categoryId = $request['categoryId'];

        $productsRequest = new ProductRequest($name, $code, $categoryId);

        if ($request['id'] == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Mandatory field ID is missing");
        }

        $productsRequest->setId($request['id']);
        $productsRequest->validate();

        $product = Products::where('id', $productsRequest->getId())->first();
        if ($product == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Record does not exist in the daabase");
        }


        $product = Products::where('name', $name)
                ->where('code', $code)
                ->where('category_id', $categoryId)
                ->where('id', "<>", $productsRequest->getId())
                ->first();
        if ($product != null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Product  Exists with the same name or code in the database ");
        }



        $product->name = $name;
        $product->code = $code;
        $product->category_id = $categoryId;
        $product->update();

        $productResponse = $this->populate($product);
        return $productResponse->toJson();
    }

    public function archive(Request $request, $id) {

        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);


        $product = ProductCategories::where('id', $id)->first();
        if ($product == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Record does not exist in the daabase");
        }
        $product->status = 'ARCHIVED';
        $product->update();
    }

    public function populate($products) {
        $productCategoryResponse = new ProductResponse();
        $productCategoryResponse->setId($products->id);
        $productCategoryResponse->setCode($products->code);
        $productCategoryResponse->setName($products->name);
        $productCategoryResponse->setCategory($products->category_id);
        $productCategoryResponse->setDateCreated($products->date_created);
        $productCategoryResponse->setCreatedBy($products->created_by);
        return $productCategoryResponse;
    }

}
