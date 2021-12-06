<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamilyDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_doctors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idCodeDoctor')->unsigned();
            $table->foreign('idCodeDoctor')->references('id')->on('online_doctors')->onDelete('cascade');
            $table->bigInteger('idCodePatient')->unsigned();
            $table->foreign('idCodePatient')->references('id')->on('patiens')->onDelete('cascade');
            $table->boolean('is_accept')->default(false);
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
        Schema::dropIfExists('family_doctors');
    }
}
