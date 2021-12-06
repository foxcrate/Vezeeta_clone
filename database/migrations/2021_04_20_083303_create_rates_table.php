<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('doctorRate')->nullable();
            $table->boolean('receiption')->nullable()->default(false);
            $table->boolean('price')->nullable()->default(false);
            $table->boolean('cleanliness')->nullable()->default(false);
            $table->boolean('nursing')->nullable()->default(false);
            $table->boolean('servicing')->nullable()->default(false);
            $table->bigInteger('patient_id')->nullable()->unsigned();
            $table->bigInteger('doctor_id')->nullable()->unsigned();
            $table->foreign('patient_id')->references('id')->on('patiens')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('online_doctors')->onDelete('cascade');
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
        Schema::dropIfExists('rates');
    }
}
