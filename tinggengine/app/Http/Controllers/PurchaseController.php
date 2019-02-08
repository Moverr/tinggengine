<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\Utils;
use App\Stock;
use App\Http\Controllers\RequestEntities\StockRequest;
use App\Stock;
use App\PurchaseOrders;

class PurchaseController extends Controller {

    private $util;

    function __construct() {
        $this->util = new Utils();
    }

    public function index(Request $request, $offset = 0, $limit = 10) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        $purchaseOrders = PurchaseOrders::offset($offset)->limit($limit)->get();
        return json_encode($purchaseOrders);
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

        $product_id = $request['product_id'];
        $reference_id = "refrence_id";
        $quantity = $request['quantity'];
        $unit_selling_price = $request['unit_selling_price'];
        $unit_purchase_price = $request['unit_purchase_price'];
        $unit_measure = $request['unit_measure'];


        $stockRequest = new StockRequest($product_id, $reference_id, $quantity, $unit_selling_price, $unit_purchase_price, $unit_measure);
        $stockRequest->validate();

        $stock = new Stock();
        $stock->product_id = $product_id;
        $stock->reference_id = "ReferenceID";
        $stock->quantity = $quantity;
        $stock->unit_selling_price = $unit_selling_price;
        $stock->unit_purchase_price = null;
        $stock->status = 'ACTIVE';
        $stock->save();

        $stockResponse = $this->populate($stock);
        return $stockResponse->toJson();
    }

    public function update(Request $request) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);


        $product_id = $request['product_id'];
        $reference_id = "refrence_id";
        $quantity = $request['quantity'];
        $unit_selling_price = $request['unit_selling_price'];
        $unit_purchase_price = $request['unit_purchase_price'];
        $unit_measure = $request['unit_measure'];

        $stockRequest = new StockRequest($product_id, $reference_id, $quantity, $unit_selling_price, $unit_purchase_price, $unit_measure);

        if ($request['id'] == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Mandatory field ID is missing");
        }

        $stockRequest->setId($request['id']);
        $stockRequest->validate();

        $stockRequest = Stock::where('id', $stockRequest->getId())->first();
        if ($product == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Record does not exist in the daabase");
        }




        $stock->product_id = $product_id;
        $stock->reference_id = "ReferenceID";
        $stock->quantity = $quantity;
        $stock->unit_selling_price = $unit_selling_price;
        $stock->unit_purchase_price = null;
        $stock->status = 'ACTIVE';
        $stock->update();

        $stockResponse = $this->populate($stock);
        return $stockResponse->toJson();
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
