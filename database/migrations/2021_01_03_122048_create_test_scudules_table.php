<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestScudulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_scudules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patient_id')->unsigned();
            $table->string('patient_name');
            $table->string('patient_phone');
            $table->string('day_name');
            $table->string('from');
            $table->string('to');
            $table->string('time')->nullable();
            $table->foreign('patient_id')->references('id')->on('patiens')->onDelete('cascade');
            $table->bigInteger('appoiment_id')->unsigned();
            $table->foreign('appoiment_id')->references('id')->on('appointments')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_scudules');
    }
}
