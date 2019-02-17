<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Contacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     

    private  $tablename = 'contacts';
   
    public function up()
    {
        Schema::create($this->tablename, function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->bigInteger('profile_id')->unsigned();
            $table->enum('contact_type',array('EMAIL','WEB','SOCIALMEDIA','TELEPHONE','POBOX','OTHERS'));  
            $table->string('details');
            $table->enum('status',array('ACTIVE','ARCHIVED'));                
            $table->bigInteger('created_by')->unsigned();
            $table->timestamp('date_created')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->bigInteger('updated_by')->nullable()->unsigned();
            $table->datetime('date_updated')->nullable();             
             
        });


        Schema::table($this->tablename, function (Blueprint $table) {  
            $table->foreign('profile_id')->references('id')->on('stock'); 
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
