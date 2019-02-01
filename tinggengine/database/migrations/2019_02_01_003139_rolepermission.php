<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Rolepermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    private  $tablename = 'rolepermission';
    


    public function up()
    {
        Schema::create($this->tablename, function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->bigInteger('role_id')->unsigned();
            $table->bigInteger('permission_id')->unsigned();                     
             
        });

         Schema::table($this->tablename, function (Blueprint $table) {  
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('permission_id')->references('id')->on('permissions');             
             
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
