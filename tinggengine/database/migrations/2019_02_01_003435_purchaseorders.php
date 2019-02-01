<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Purchaseorders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     private  $tablename = 'purchaseorders';
    


    public function up()
    {
        Schema::create($this->tablename, function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->bigIncrements('stockist_id'); 
            $table->datetime('order_date')->nullable();  
            $table->string('reference_id')->unique();     
            $table->decimal('total_amount', 5, 2);  
            $table->enum('status',array('PENDING','APPROVED','REJECTED','REVERSED','ARCHIVED'));            
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
