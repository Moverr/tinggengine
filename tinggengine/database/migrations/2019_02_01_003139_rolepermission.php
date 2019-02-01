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
            $table->bigInteger('role_id');
            $table->bigInteger('permission_id');                     
             
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
