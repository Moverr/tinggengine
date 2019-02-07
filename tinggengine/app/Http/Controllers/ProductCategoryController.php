<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\Utils;
use App\ProductCategories;
use App\Http\Controllers\RequestEntities\ProductCategoryRequest;
use App\Http\Controllers\ResponseEntities\ProductCategoryResponse;

class ProductCategoryController extends Controller {

    private $util;

    function __construct() {
        $this->util = new Utils();
    }

    public function index(Request $request, $offset = 0, $limit = 10) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        $productCategories = ProductCategories::offset($offset)->limit($limit)->get();

        $productcategoryResponses = [];
        foreach ($productCategories as $record) {
            $productcategoryResponses [] = $this->populate($record)->toJson();
        }

        return ($productcategoryResponses);
    }

    public function get(Request $request, $id) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        $productCategories = ProductCategories::where('id', $id)->get();
        if ($productCategories == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Record does not exist in the daabase");
        }

        $productResponse = $this->populate($productCategories[0]);
        return $productResponse->toJson();
    }

    public function save(Request $request) {

        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        $name = $request['name'];
        $code = $request['code'];
        $createdBy = $autneticaton_response->getId();

        $productCategoryRequest = new ProductCategoryRequest($name, $code);
        $productCategoryRequest->validate();

        //set the author of the system :: 
        $productCategoryRequest->setCreatedBy($createdBy);



        $productCategory = ProductCategories::where('name', $name)
                ->where('code', $code)
                ->first();
        if ($productCategory != null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Product Category Exists with the same name or code in the database ");
        }

        $productCategory = new ProductCategories();
        $productCategory->name = $name;
        $productCategory->code = $code;
        $productCategory->status = 'ACTIVE';
        $productCategory->created_by = $createdBy;
        $productCategory->save();

        $productResponse = $this->populate($productCategory);
        return $productResponse->toJson();
    }

    public function update(Request $request) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        $name = $request['name'];
        $code = $request['code'];

        $productCategoryRequest = new ProductCategoryRequest($name, $code);

        if ($request['id'] == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Mandatory field ID is missing");
        }

        $productCategoryRequest->setId($request['id']);
        $productCategoryRequest->validate();

        $user = ProductCategories::where('id', $productCategoryRequest->getId())->first();
        if ($user == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Record does not exist in the daabase");
        }


        $productCategory = ProductCategories::where('name', $name)
                ->where('code', $code)
                ->where('id', "<>", $productCategoryRequest->getId())
                ->first();
        if ($productCategory != null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Product Category Exists with the same name or code in the database ");
        }



        $productCategory->name = $name;
        $productCategory->code = $code;
        $productCategory->update();

        $productResponse = $this->populate($productCategory);
        return $productResponse->toJson();
    }

    public function archive(Request $request, $id) {

        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);


        $user = ProductCategories::where('id', $id)->first();
        if ($user == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Record does not exist in the daabase");
        }
        $user->status = 'ARCHIVED';
        $user->update();
    }

    public function populate($productCategories) {
        $productCategoryResponse = new ProductCategoryResponse();
        $productCategoryResponse->setId($productCategories->id);
        $productCategoryResponse->setCreatedBy($productCategories->created_by);
        $productCategoryResponse->setName($productCategories->name);
        $productCategoryResponse->setCode($productCategories->code);
        $productCategoryResponse->setDateCreated($productCategories->date_created);
        $productCategoryResponse->setStatus($productCategories->status);
        return $productCategoryResponse;
    }

}
