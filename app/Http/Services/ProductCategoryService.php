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
use Exception;

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
        $productCategories = ProductCategories::offset($offset)->limit($limit)->orderBy('date_created', 'desc')->get();

        $productcategoryResponses = [];
        foreach ($productCategories as $record) {
            $productcategoryResponses [] = $this->populate($record)->toString();
        }

        return ($productcategoryResponses);
    }

    public function get($id, $autneticaton_response = null) {
        $productCategories = ProductCategories::where('id', $id)->get();
        if ($productCategories == null) {
            throw new Exception("Record does not exist in the daabase", 403);
        }

        $productResponse = $this->populate($productCategories[0]);
        return $productResponse->toString();
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
            throw new Exception("Product Category Exists with the same name or code in the database ", 403);
        }

        $productCategory = new ProductCategories();
        $productCategory->name = $name;
        $productCategory->code = $code;
        $productCategory->status = 'ACTIVE';
        $productCategory->created_by = $createdBy;
        $productCategory->save();

        $productResponse = $this->populate($productCategory);
        return $productResponse->toString();
    }

    public function update($request, $autneticaton_response = null) {

        $name = $request['name'];
        $code = $request['code'];
        $createdBy = $autneticaton_response->getId();

 
        $productCategoryRequest = new ProductCategoryRequest($name, $code);
        $productCategoryRequest->validate();

        //set the author of the system :: 
        $productCategoryRequest->setCreatedBy($createdBy);

        
        if ($request['id'] == null) {
            throw new Exception("Mandatory field ID is missing");
        }

        $productCategoryRequest->setId($request['id']);
         
        $productCategory = ProductCategories::where('id', $productCategoryRequest->getId())->first();
        if ($productCategory == null) {
            throw new Exception("Record does not exist in the daabase", 403);
        }


        $product_category = ProductCategories::where('name', $name)
                ->where('code', $code)
                ->where('id', "<>", $productCategoryRequest->getId())
                ->first();
        if ($product_category != null) {
            throw new Exception("Product Category Exists with the same name or code in the database ", 403);
        }



         
        $productCategory->name = $productCategoryRequest->getName();
        $productCategory->code = $productCategoryRequest->getCode();
        $productCategory->updated_by = $createdBy;

        $productCategory->update();

        $productResponse = $this->populate($productCategory);
        return $productResponse->toString();
    }

    public function archive($id, $autneticaton_response = null) {

        $user = ProductCategories::where('id', $id)->first();
        if ($user == null) {
            throw new Exception("Record does not exist in the daabase", 403);
        }
        $user->status = 'ARCHIVED';
        $user->update();
    }

    public function populate($productCategories) {
        $productCategoryResponse = new ProductCategoryResponse();
        $productCategoryResponse->setId($productCategories->id);
        $productCategoryResponse->setCreatedBy($productCategories->Author->username);
        $productCategoryResponse->setName($productCategories->name);
        $productCategoryResponse->setCode($productCategories->code);
        $productCategoryResponse->setDateCreated($this->util->convertToTimestamp($productCategories->date_created));
        $productCategoryResponse->setStatus($productCategories->status);
        return $productCategoryResponse;
    }

}
