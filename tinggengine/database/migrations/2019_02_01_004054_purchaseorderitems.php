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
            $table->bigInteger('purchase_order_id');
            $table->bigInteger('product_id'); 
            $table->bigInteger('quantity');     
            $table->decimal('unit_selling_price', 5, 2);     
            $table->decimal('total_selling_price', 5, 2);  
            $table->enum('status',array('ACTIVE','ARCHIVED'));            
            $table->bigInteger('created_by');
            $table->timestamp('date_created')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->bigInteger('updated_by')->nullable();
            $table->datetime('date_updated')->nullable();             
             
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
