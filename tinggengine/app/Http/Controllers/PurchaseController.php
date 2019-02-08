<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\Utils;
use App\Stock;
use App\Http\Controllers\RequestEntities\StockRequest;
use App\PurchaseOrders;
use App\Http\Controllers\ResponseEntities\PurchaseOrderResponse;

class PurchaseController extends Controller {

    private $util;

    function __construct() {
        $this->util = new Utils();
    }

    public function index(Request $request, $offset = 0, $limit = 10) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        $purchaseOrders = PurchaseOrders::offset($offset)->limit($limit)->get();


        $purchaseorderresponses = [];
        foreach ($purchaseOrders as $record) {
            $purchaseorderresponses [] = $this->populate($record)->toJson();
        }



        return ($purchaseorderresponses);
    }

    public function get(Request $request, $id) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        $purchaseorder = PurchaseOrders::where('id', $id)->get();
        if ($purchaseorder == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Record does not exist in the daabase");
        }

        $productResponse = $this->populate($purchaseorder);
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

    public function populate($purchaseorder) {
        $purchaseorderresponse = new PurchaseOrderResponse();
        $purchaseorderresponse->setStockist_id($purchaseorder->stockist_id);
        $purchaseorderresponse->setOrder_date($purchaseorder->order_date);
        $purchaseorderresponse->setReference_id($purchaseorder->reference_id);
        $purchaseorderresponse->setTotal_amount($purchaseorder->total_amount);
        $purchaseorderresponse->setStatus($purchaseorder->status);
        $purchaseorderresponse->setCreated_by($purchaseorder->created_by);
        $purchaseorderresponse->setDate_created($purchaseorder->date_created);
        $purchaseorderresponse->setId($purchaseorder->id);

        return $purchaseorderresponse;
    }

}
