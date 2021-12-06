<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_labs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('doctor_name');
            $table->string('idCode');
            $table->string('address');
            $table->string('phoneNumber');
            $table->longText('appointments');
            $table->string('latitude');
            $table->string('longitude');
            $table->bigInteger('lab_id')->unsigned()->nullable();
            $table->foreign('lab_id')->references('id')->on('labs')->onDelete('cascade');
            $table->bigInteger('xray_id')->unsigned()->nullable();
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
        Schema::dropIfExists('appointment_labs');
    }
}
