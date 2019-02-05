<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\Utils;
use App\Stock;
use App\Http\Controllers\RequestEntities\StockRequest;
use App\Stock;

class StockController extends Controller {

    private $util;

    function __construct() {
        $this->util = new Utils();
    }

    public function index(Request $request, $offset = 0, $limit = 10) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        $stock = Stock::offset($offset)->limit($limit)->get();
        return json_encode($stock);
    }

    public function get(Request $request, $id) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        $stock = Products::where('id', $id)->get();
        if ($stock == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Record does not exist in the daabase");
        }

        $productResponse = $this->populate($stock);
        return $productResponse->toJson();
    }

    public function save(Request $request) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        $product_id = $request['name'];
        $quantity = $request['code'];
        $unit_selling_price = $request['categoryId'];
        $unit_measure = $request['categoryId'];

        $productCategoryRequest = new StockRequest($product_id, $quantity, $unit_selling_price, $unit_measure);
        $productCategoryRequest->validate();

        $stock = Stock::where('name', $name)
                ->where('code', $code)
                ->first();
        if ($stock != null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Product   Exists with the same name or code in the database ");
        }

        $stock = new Products();
        $stock->name = $name;
        $stock->code = $code;
        $stock->category_id = $categoryId;
        $stock->status = 'ACTIVE';
        $stock->save();

        $productResponse = $this->populate($stock);
        return $productResponse->toJson();
    }

    public function update(Request $request) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        $name = $request['name'];
        $code = $request['code'];
        $categoryId = $request['categoryId'];

        $productsRequest = new StockRequest($name, $code, $categoryId);

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
        $productCategoryResponse->setId($products[0]->id);
        $productCategoryResponse->setCode($products[0]->code);
        $productCategoryResponse->setName($products[0]->name);
        $productCategoryResponse->setCategory($products[0]->category_id);
        $productCategoryResponse->setDateCreated("N/A");
        return $productCategoryResponse;
    }

}
