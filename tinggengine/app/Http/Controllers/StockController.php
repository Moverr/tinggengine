<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\Utils;
use App\Stock;
use App\Http\Controllers\RequestEntities\StockRequest;
use App\Http\Controllers\ResponseEntities\StockResponse;
use App\StockTransactions;

class StockController extends Controller {

    private $util;

    function __construct() {
        $this->util = new Utils();
    }

    public function index(Request $request, $offset = 0, $limit = 10) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);
        $stock = Stock::offset($offset)->limit($limit)->get();
        $productResponses = [];
        foreach ($stock as $record) {
            $productResponses [] = $this->populate($record)->toJson();
        }

        return $productResponses;
    }

    public function get(Request $request, $id) {
        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);

        $stock = Stock::where('id', $id)->get();
        if ($stock == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Record does not exist in the daabase");
        }

        $productResponse = $this->populate($stock[0]);
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
        $createdBy = $autneticaton_response->getId();



        $existing_stock = Stock::where('product_id', $product_id)
                ->first();
        if ($existing_stock != null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException(" Stock exists under the same product , kindly update instead of creating new stock ");
        }



        $stockRequest = new StockRequest($product_id, $reference_id, $quantity, $unit_selling_price, $unit_purchase_price, $unit_measure);
        $stockRequest->validate();

        $stock = new Stock();
        $stock->product_id = $product_id;
        $stock->reference_id = $this->util->incrementalHash();
        $stock->quantity = $quantity;
        $stock->unit_selling_price = $unit_selling_price;
        $stock->unit_purchase_price = $unit_purchase_price;
        $stock->unit_measure = $unit_measure;
        $stock->created_by = $createdBy;
        $stock->status = 'ACTIVE';
        $stock->save();

        //todo create stock transaction history

        $stockTransaction = new StockTransactions();
        $stockTransaction->stock_id = $stock->id;
        $stockTransaction->quantity = $quantity;
        $stockTransaction->unit_selling_price = $unit_selling_price;
        $stockTransaction->unit_purchase_price = $unit_purchase_price;
        $stockTransaction->unit_measure = $unit_measure;
        $stockTransaction->created_by = $createdBy;
        $stockTransaction->status = 'ACTIVE';
        $stockTransaction->transaction_type = 'IN';
        $stockTransaction->save();


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
        $createdBy = $autneticaton_response->getId();

        $stockRequest = new StockRequest($product_id, $reference_id, $quantity, $unit_selling_price, $unit_purchase_price, $unit_measure);

        if ($request['id'] == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Mandatory field ID is missing");
        }

        $stockRequest->setId($request['id']);
        $stockRequest->validate();

        $stockResult = Stock::where('id', $stockRequest->getId())->first();
        if ($stockResult == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Record does not exist in the daabase");
        }




        $stock = new Stock();
        $stock->product_id = $product_id;
        $stock->reference_id = $stockResult->reference_id;
        $stock->quantity = $quantity;
        $stock->unit_selling_price = $unit_selling_price;
        $stock->unit_purchase_price = $unit_purchase_price;
        $stock->unit_measure = $unit_measure;
        $stock->created_by = $createdBy;
        $stock->status = 'ACTIVE';

        $stock->update();



        $stockTransaction = new StockTransactions();
        $stockTransaction->stock_id = $stockRequest->getId();
        $stockTransaction->quantity = $quantity;
        $stockTransaction->unit_selling_price = $unit_selling_price;
        $stockTransaction->unit_purchase_price = $unit_purchase_price;
        $stockTransaction->unit_measure = $unit_measure;
        $stockTransaction->created_by = $createdBy;
        $stockTransaction->status = 'ACTIVE';
        $stockTransaction->transaction_type = 'UPDATE';
        $stockTransaction->save();


        $stockResponse = $this->populate($stock);
        return $stockResponse->toJson();
    }

    public function archive(Request $request, $id) {

        $authentic = $request->header('authentication');
        $autneticaton_response = $this->util->validateAuthenction($authentic);


        $stock = Stock::where('id', $id)->first();
        if ($stock == null) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException("Record does not exist in the daabase");
        }
        $stock->status = 'ARCHIVED';
        $stock->update();
    }

    public function populate($stock) {
        $stockResponse = new StockResponse();
        $stockResponse->setId($stock->id);
        $stockResponse->setReference($stock->reference_id);
        $stockResponse->setProduct($stock->product_id);
        $stockResponse->setQuantity($stock->quantity);
        $stockResponse->setUnitsellingprice($stock->unit_selling_price);
        $stockResponse->setUnitpurchaseprice($stock->unit_purchase_price);
        $stockResponse->setUnitmeasure($stock->unit_measure);
        $stockResponse->setStatus($stock->status);
        $stockResponse->setCreatedBy($stock->created_by);
        $stockResponse->setDateCreated($stock->date_created);
        return $stockResponse;
    }

}
