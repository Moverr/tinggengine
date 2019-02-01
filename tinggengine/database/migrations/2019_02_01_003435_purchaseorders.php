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
            $table->bigInteger('stockist_id')->unsigned();
            $table->datetime('order_date')->nullable();  
            $table->string('reference_id')->unique();     
            $table->decimal('total_amount', 5, 2);  
            $table->enum('status',array('PENDING','APPROVED','REJECTED','REVERSED','ARCHIVED'));            
            $table->bigInteger('created_by')->unsigned();
            $table->timestamp('date_created')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->bigInteger('updated_by')->nullable()->unsigned();
            $table->datetime('date_updated')->nullable();            
             
        });


         Schema::table($this->tablename, function (Blueprint $table) {  
            $table->foreign('stockist_id')->references('id')->on('stockists');
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
