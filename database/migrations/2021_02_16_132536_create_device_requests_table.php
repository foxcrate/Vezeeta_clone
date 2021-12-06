<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeviceRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('accept')->default(false)->nullable();
            $table->string('quantity')->nullable();
            $table->bigInteger('patientIdRequest')->unsigned()->nullable();
            $table->bigInteger('device_id')->unsigned()->nullable();
            $table->foreign('device_id')->references('id')->on('medical_devices')->onDelete('cascade');
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
        Schema::dropIfExists('device_requests');
    }
}
