<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Purchaseorderitems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   private  $tablename = 'purchaseorderitems';
    

/*
TODO: MEASUREMENT SCENARIOS IS AN IMPORTANT ASPECT OF THIS APPLICATION 
 */

    public function up()
    {
        Schema::create($this->tablename, function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->bigInteger('purchase_order_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('quantity');     
            $table->decimal('unit_selling_price', 5, 2);     
            $table->decimal('total_selling_price', 5, 2);  
            $table->enum('status',array('ACTIVE','ARCHIVED'));            
            $table->bigInteger('created_by')->unsigned();
            $table->timestamp('date_created')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->bigInteger('updated_by')->nullable()->unsigned();
            $table->datetime('date_updated')->nullable();             
             
        });

        Schema::table($this->tablename, function (Blueprint $table) { 
            $table->foreign('purchase_order_id')->references('id')->on('purchaseorders');
            $table->foreign('product_id')->references('id')->on('products'); 
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');             
             
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists($this->tablename);
    }
}
