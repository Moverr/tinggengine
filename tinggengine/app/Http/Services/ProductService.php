<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;

use App\Http\Helpers\Utils;
use App\Products;
use App\Http\Controllers\ResponseEntities\ProductResponse;
use App\Http\Controllers\RequestEntities\ProductRequest;

/**
 * Description of ProductService
 *
 * @author mover  
 */
class ProductService {

    private static $instance;
    private $util;

    function __construct() {
        $this->util = new Utils();
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new ProductService();
        }
        return self::$instance;
    }

    public function getList($offset, $limit, $autneticaton_response = null) {
        $products = Products::offset($offset)->limit($limit)->get();
        $productResponses = [];
        foreach ($products as $record) {
            $productResponses [] = $this->populate($record)->toJson();
        }
        return ($productResponses);
    }

    public function get($id, $autneticaton_response = null) {
        $products = Products::where('id', $id)->get();
        if ($products == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Record does not exist in the daabase");
        }

        $productResponse = $this->populate($products[0]);
        return $productResponse->toJson();
    }

    public function save($request, $autneticaton_response = null) {
        $name = $request['name'];
        $code = $request['code'];
        $categoryId = $request['categoryId'];
        $createdBy = $autneticaton_response->getId();


        $productCategoryRequest = new ProductRequest($name, $code, $categoryId);
        $productCategoryRequest->validate();

        //set the author of the system :: 
        $productCategoryRequest->setCreatedBy($createdBy);

//        add a composite key to avoid multiple inserts of the same
//                ->where('category_id', $categoryId)

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

    public function update($request, $authentication = null) {

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

    public function archive($id, $autneticaton_response = null) {
        $product = Products::where('id', $id)->first();
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
        $productCategoryResponse->setStatus($products->status);
        return $productCategoryResponse;
    }

}
