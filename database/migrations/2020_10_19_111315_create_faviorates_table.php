<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavioratesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faviorates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('idCode');
            $table->string('address');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('image')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->string('type')->nullable();
            $table->bigInteger('doctor_id')->unsigned()->nullable();
            $table->bigInteger('nurse_id')->unsigned()->nullable();
            $table->bigInteger('lab_id')->unsigned()->nullable();
            $table->bigInteger('xray_id')->unsigned()->nullable();
            $table->bigInteger('pharmacy_id')->unsigned()->nullable();
            $table->bigInteger('patient_id')->unsigned();
            $table->foreign('doctor_id')->references('id')->on('online_doctors')->onDelete('cascade');
            $table->foreign('nurse_id')->references('id')->on('nurses')->onDelete('cascade');
            $table->foreign('lab_id')->references('id')->on('labs')->onDelete('cascade');
            $table->foreign('xray_id')->references('id')->on('xrays')->onDelete('cascade');
            $table->foreign('pharmacy_id')->references('id')->on('pharmacies')->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('patiens')->onDelete('cascade');
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
        Schema::dropIfExists('faviorates');
    }
}
