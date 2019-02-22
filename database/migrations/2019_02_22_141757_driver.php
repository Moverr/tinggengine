<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Driver extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    private $tablename = 'drivers';

    public function up() {
        Schema::create($this->tablename, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reference_id')->unique();
            $table->datetime('join_date');
            $table->bigInteger('user_id');
            $table->bigInteger('country_code');
            $table->bigInteger('phone_number');
            $table->bigInteger('dealer_id');
            $table->enum('status', array('ACTIVE', 'ARCHIVED'));
            $table->bigInteger('created_by')->unsigned();
            $table->timestamp('date_created')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->bigInteger('updated_by')->nullable()->unsigned();
            $table->datetime('date_updated')->nullable();
        });

        Schema::table($this->tablename, function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
             $table->foreign('dealer_id')->references('id')->on('dealers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists($this->tablename);
    }

}
