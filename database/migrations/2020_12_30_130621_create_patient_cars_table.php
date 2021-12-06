<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_cars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ampulanceType');
            $table->string('patientName');
            $table->string('phoneNumber');
            $table->string('date');
            $table->string('address');
            $table->string('addressDist');
            $table->string('carType');
            $table->string('PurposeOfTheTipe');
            $table->string('requireQues')->nullable();
            $table->bigInteger('patient_id')->unsigned();
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
        Schema::dropIfExists('patient_cars');
    }
}
