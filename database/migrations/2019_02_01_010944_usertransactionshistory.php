<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Usertransactionshistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   private  $tablename = 'usertransactionshistory';
   
    public function up()
    {
        Schema::create($this->tablename, function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->enum('action_name',array('CREATE','EDIT','ARCHIVE','RESTORE','SEARCH','LIST','GET'));  
            $table->string('entity_name');
            $table->string('api_url');
            $table->bigInteger('resource_id');
            $table->string('command_as_json');                           
            $table->bigInteger('created_by');
            $table->timestamp('date_created')->default(DB::raw('CURRENT_TIMESTAMP'));                      
             
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
