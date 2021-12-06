<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientReshoutasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_reshoutas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idpatient')->nullable()->unsigned();
            $table->foreign('idpatient')->references('id')->on('patiens')->onDelete('cascade');
            $table->bigInteger('idXray')->nullable()->unsigned();
            $table->foreign('idXray')->references('id')->on('xrays')->onDelete('cascade');
            $table->bigInteger('idLab')->nullable()->unsigned();
            $table->foreign('idLab')->references('id')->on('labs')->onDelete('cascade');
            $table->string('link')->nullable();
            $table->string('information')->nullable();

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
        Schema::dropIfExists('patient_reshoutas');
    }
}
