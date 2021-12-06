<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicationRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medication_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('accept')->default(false)->nullable();
            $table->string('quantity')->nullable();
            $table->bigInteger('patientIdRequest')->unsigned()->nullable();
            $table->bigInteger('medication_id')->unsigned()->nullable();
            $table->foreign('medication_id')->references('id')->on('medications')->onDelete('cascade');
            $table->bigInteger('patientIdSender')->unsigned()->nullable();
            $table->foreign('patientIdSender')->references('id')->on('patiens')->onDelete('cascade');
            $table->foreign('patientIdRequest')->references('id')->on('patiens')->onDelete('cascade');
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
        Schema::dropIfExists('medication_requests');
    }
}
