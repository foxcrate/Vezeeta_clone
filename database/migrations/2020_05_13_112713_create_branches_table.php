<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->string('password')->nullable();
            $table->boolean('is_xray')->default(false);
            $table->boolean('is_lab')->default(false);
            $table->boolean('is_pharmacy')->default(false);
            $table->bigInteger('hosptail_id')->unsigned()->nullable();
            $table->bigInteger('clinic_id')->unsigned()->nullable();
            $table->bigInteger('xray_id')->unsigned()->nullable();
            $table->bigInteger('lab_id')->unsigned()->nullable();
            $table->bigInteger('pharmacy_id')->unsigned()->nullable();
            $table->foreign('hosptail_id')->references('id')->on('hosptails')->onDelete('cascade');
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
            $table->foreign('xray_id')->references('id')->on('xrays')->onDelete('cascade');
            $table->foreign('lab_id')->references('id')->on('labs')->onDelete('cascade');
            $table->foreign('pharmacy_id')->references('id')->on('pharmacies')->onDelete('cascade');
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
        Schema::dropIfExists('branches');
    }
}
