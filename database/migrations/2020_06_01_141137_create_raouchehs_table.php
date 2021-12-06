<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRaouchehsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raouchehs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('prescription')->nullable();
            $table->string('weight')->nullable();
            $table->string('date')->nullable();
            $table->string('temperature')->nullable();
            $table->string('blood_pressure')->nullable();
            $table->string('diabetics')->nullable();
            $table->string('jaw_type')->nullable();
            $table->string('jaw_direction')->nullable();
            $table->string('teeth_type')->nullable();
            $table->string('eye_type')->nullable();
            $table->Text('medication')->nullable();
            $table->bigInteger('patient_id')->unsigned();
            $table->bigInteger('doctor_id')->unsigned()->nullable();
            $table->bigInteger('online_doctor_id')->unsigned()->nullable();
            $table->foreign('online_doctor_id')->references('id')->on('online_doctors')->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('patiens')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
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
        Schema::dropIfExists('raouchehs');
    }
}
