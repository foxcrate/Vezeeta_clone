<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientRaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_rays', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->text('date')->nullable();
            $table->text('ray_name');
            $table->text('link')->nullable();
            $table->bigInteger('patient_id')->unsigned();
            $table->bigInteger('doctor_id')->unsigned()->nullable();
            $table->bigInteger('online_doctor_id')->unsigned()->nullable();
            $table->bigInteger('rocata_id')->unsigned()->nullable();
            $table->bigInteger('lab_id')->unsigned()->nullable();
            $table->foreign('patient_id')->references('id')->on('patiens')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->foreign('online_doctor_id')->references('id')->on('online_doctors')->onDelete('cascade');
            $table->foreign('rocata_id')->references('id')->on('raouchehs')->onDelete('cascade');
            $table->foreign('lab_id')->references('id')->on('labs')->onDelete('cascade');
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
        Schema::dropIfExists('patient_rays');
    }
}
