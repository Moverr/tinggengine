<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Stockists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */ 
     private  $tablename = 'stockists';
    


    public function up()
    {
        Schema::create($this->tablename, function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->string('reference_id')->unique();
            $table->datetime('join_date');
            $table->bigInteger('user_id');
            $table->enum('status',array('ACTIVE','ARCHIVED'));
            $table->boolean('is_system');
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
