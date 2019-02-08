<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

use App\Http\Helpers\Utils;
use App\ProductCategories;
use App\Http\Controllers\RequestEntities\ProductCategoryRequest;
use App\Http\Controllers\ResponseEntities\ProductCategoryResponse;

/**
 * Description of ProductCategoryService
 *
 * @author mover  
 */
class ProductCategoryService {

    private static $instance;
    private $util;

    function __construct() {
        $this->util = new Utils();
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new ProductCategoryService();
        }
        return self::$instance;
    }

    public function getList($offset, $limit, $autneticaton_response = null) {
        $productCategories = ProductCategories::offset($offset)->limit($limit)->get();

        $productcategoryResponses = [];
        foreach ($productCategories as $record) {
            $productcategoryResponses [] = $this->populate($record)->toJson();
        }

        return ($productcategoryResponses);
    }

    public function get($id, $autneticaton_response = null) {
        $purchaseorder = PurchaseOrders::where('id', $id)->get();
        $productCategories = ProductCategories::where('id', $id)->get();
        if ($productCategories == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Record does not exist in the daabase");
        }

        $productResponse = $this->populate($productCategories[0]);
        return $productResponse->toJson();
    }

    public function save($request, $autneticaton_response = null) {
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

    public function update($request, $authentication = null) {

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


        $productCategory = new ProductCategories();
        $productCategory->id = $productCategoryRequest->getId();
        $productCategory->name = $name;
        $productCategory->code = $code;
        $productCategory->update();

        $productResponse = $this->populate($productCategory);
        return $productResponse->toJson();
    }

    public function archive($id, $autneticaton_response = null) {
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
