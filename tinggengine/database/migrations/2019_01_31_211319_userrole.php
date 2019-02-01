<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Userrole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    private  $tablename = 'userrole';
    


    public function up()
    {
        Schema::create($this->tablename, function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->string('user_id');
            $table->string('role_id');  
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
