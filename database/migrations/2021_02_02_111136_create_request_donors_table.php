<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestDonorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_donors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('accept')->default(false)->nullable();
            $table->bigInteger('patientIdRequest')->unsigned()->nullable();
            $table->bigInteger('donor_id')->unsigned()->nullable();
            $table->foreign('donor_id')->references('id')->on('donors')->onDelete('cascade');
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
        Schema::dropIfExists('request_donors');
    }
}
