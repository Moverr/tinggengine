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
use Exception;

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
        $products = Products::offset($offset)->limit($limit)->orderBy('date_created', 'desc')->get();
        $productResponses = [];
        foreach ($products as $record) {
            $productResponses [] = $this->populate($record)->toString();
        }
        return ($productResponses);
    }

    public function get($id, $autneticaton_response = null) {
        $products = Products::where('id', $id)->get();
        if ($products == null) {
            throw new Exception("Record does not exist in the daabase", 403);
        }

        $productResponse = $this->populate($products[0]);
        return $productResponse->toString();
    }

    public function save($request, $autneticaton_response = null) {
        $name = $request['name'];
        $code = $request['code'];
        $categoryId = $request['categoryId'];
        $createdBy = $autneticaton_response->getId();


        $productRequest = new ProductRequest($name, $code, $categoryId);
        $productRequest->validate();

        //set the author of the system :: 
        $productRequest->setCreatedBy($createdBy);

//        add a composite key to avoid multiple inserts of the same
//                ->where('category_id', $categoryId)

        $products = Products::where('name', $productRequest->getName())
                ->where('code', $code)
                ->first();
        if ($products != null) {
            throw new Exception("Product   Exists with the same name or code in the database ", 403);
        }

        $products = new Products();
        $products->name = $productRequest->getName();
        $products->code = $productRequest->getCode();
        $products->category_id = $productRequest->getCategoryId();
        $products->status = 'ACTIVE';
        $products->created_by = $createdBy;
        $products->save();

        $productResponse = $this->populate($products);
        return $productResponse->toString();
    }

    public function update($request, $authentication = null) {

        $name = $request['name'];
        $code = $request['code'];
        $categoryId = $request['categoryId'];

        $productsRequest = new ProductRequest($name, $code, $categoryId);

        if ($request['id'] == null) {
            throw new Exception("Mandatory field ID is missing", 403);
        }

        $productsRequest->setId($request['id']);
        $productsRequest->validate();

        $product = Products::where('id', $productsRequest->getId())->first();
        if ($product == null) {
            throw new Exception("Record does not exist in the daabase", 403);
        }


        $productVal = Products::where('name', $name)
                ->where('code', $code)
                ->where('category_id', $categoryId)
                ->where('id', "<>", $productsRequest->getId())
                ->first();
        if ($productVal != null) {
            throw new Exception("Product  Exists with the same name or code in the database ", 403);
        }

        $product->name = $name;
        $product->code = $code;
        $product->category_id = $categoryId;
        $product->update();

        $productResponse = $this->populate($product);
        return $productResponse->toString();
    }

    public function archive($id, $autneticaton_response = null) {
        $product = Products::where('id', $id)->first();
        if ($product == null) {
            throw new Exception("Record does not exist in the daabase", 403);
        }
        $product->status = 'ARCHIVED';
        $product->update();
    }

    public function populate($products) {
        $productResponse = new ProductResponse();
        $productResponse->setId($products->id);
        $productResponse->setCode($products->code);
        $productResponse->setName($products->name);
        $productResponse->setCategory(["id" => $products->id, "name" => $products->Category->name,]);
        $productResponse->setDateCreated($this->util->convertToTimestamp($products->date_created));
        $productResponse->setCreatedBy($products->Author->username);
        $productResponse->setStatus($products->status);
        return $productResponse;
    }

}
