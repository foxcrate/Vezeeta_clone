<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHospitalAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospital_appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('doctor_name')->nullable();
            $table->string('address')->nullable();
            $table->string('special')->nullable();
            $table->string('idCode')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->longText('image')->nullable();
            $table->longText('appointments')->nullable();
            $table->string('fees')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->bigInteger('doctor_id')->unsigned()->nullable();
            $table->foreign('doctor_id')->references('id')->on('online_doctors')->onDelete('cascade');
            $table->bigInteger('hospital_id')->unsigned()->nullable();
            $table->foreign('hospital_id')->references('id')->on('hosptails')->onDelete('cascade');
            $table->bigInteger('clinic_id')->unsigned()->nullable();
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
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
        Schema::dropIfExists('hospital_appointments');
    }
}
