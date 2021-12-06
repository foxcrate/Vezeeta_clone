<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClupTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clup_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaction');
            $table->integer('point');
            $table->integer('balance');
            $table->bigInteger('patient_id')->unsigned()->nullable();
            $table->foreign('patient_id')->references('id')->on('patiens')->onDelete('cascade');
            $table->bigInteger('doctor_id')->unsigned()->nullable();
            $table->foreign('doctor_id')->references('id')->on('online_doctors')->onDelete('cascade');
            $table->bigInteger('xray_id')->unsigned()->nullable();
            $table->foreign('xray_id')->references('id')->on('xrays')->onDelete('cascade');
            $table->bigInteger('lab_id')->unsigned()->nullable();
            $table->foreign('lab_id')->references('id')->on('labs')->onDelete('cascade');
            $table->bigInteger('pharmacy_id')->unsigned()->nullable();
            $table->foreign('pharmacy_id')->references('id')->on('pharmacies')->onDelete('cascade');
            $table->bigInteger('nurse_id')->unsigned()->nullable();
            $table->foreign('nurse_id')->references('id')->on('nurses')->onDelete('cascade');
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
        Schema::dropIfExists('clup_transactions');
    }
}
