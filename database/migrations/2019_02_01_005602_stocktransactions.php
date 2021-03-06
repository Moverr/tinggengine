<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Stocktransactions extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    private $tablename = 'stocktransactions';

    /*
      TODO: MEASUREMENT SCENARIOS IS AN IMPORTANT ASPECT OF THIS APPLICATION
     */

    public function up() {
        Schema::create($this->tablename, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('stock_id')->unsigned();
            $table->bigInteger('quantity');
            $table->decimal('unit_selling_price', 5, 2);
            $table->decimal('unit_purchase_price', 5, 2);
            $table->string('unit_measure');
            $table->enum('transaction_type', array('IN', 'OUT', 'UPDATE'));
            $table->enum('status', array('ACTIVE', 'ARCHIVED'));
            $table->bigInteger('created_by')->unsigned();
            $table->timestamp('date_created')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->bigInteger('updated_by')->nullable()->unsigned();
            $table->datetime('date_updated')->nullable();
        });


        Schema::table($this->tablename, function (Blueprint $table) {
            $table->foreign('stock_id')->references('id')->on('stock');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists($this->tablename);
    }

}
