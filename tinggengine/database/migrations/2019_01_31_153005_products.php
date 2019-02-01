<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    private  $tablename = 'products';
    

    public function up()
    {
        Schema::enableForeignKeyConstraints();

        Schema::create($this->tablename, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('code')->unique();
            $table->bigInteger('category_id')->unsigned();
            $table->enum('status',array('ACTIVE','ARCHIVED'));
            $table->bigInteger('created_by')->unsigned();
            $table->timestamp('date_created')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->bigInteger('updated_by')->nullable()->unsigned();
            $table->datetime('date_updated')->nullable();  

        });


         Schema::table('products', function (Blueprint $table) {        

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');            
            $table->foreign('category_id')->references('id')->on('productcategories');
             
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
