<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorScudulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_scudules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patient_id')->unsigned();
            $table->string('patient_name')->nullable();
            $table->string('patient_phone')->nullable();
            $table->string('day_name');
            $table->string('from');
            $table->string('to');
            $table->string('time')->nullable();
            $table->boolean('is_accept')->nullable()->default(false);
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
        Schema::dropIfExists('doctor_scudules');
    }
}
