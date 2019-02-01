<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  private  $tablename = 'productcategories';

    public function up()
    {
        Schema::create($this->tablename, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('code')->unique();
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
