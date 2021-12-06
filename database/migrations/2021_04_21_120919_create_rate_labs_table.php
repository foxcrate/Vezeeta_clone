<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRateLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rate_labs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rate')->nullable();
            $table->boolean('receiption')->nullable()->default(false);
            $table->boolean('price')->nullable()->default(false);
            $table->boolean('cleanliness')->nullable()->default(false);
            $table->boolean('servicing')->nullable()->default(false);
            $table->bigInteger('patient_id')->nullable()->unsigned();
            $table->bigInteger('lab_id')->nullable()->unsigned();
            $table->bigInteger('xray_id')->nullable()->unsigned();
            $table->foreign('patient_id')->references('id')->on('patiens')->onDelete('cascade');
            $table->foreign('lab_id')->references('id')->on('labs')->onDelete('cascade');
            $table->foreign('xray_id')->references('id')->on('xrays')->onDelete('cascade');
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
        Schema::dropIfExists('rate_labs');
    }
}
