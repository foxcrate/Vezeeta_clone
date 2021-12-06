<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnlineDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_doctors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image')->nullable();
            $table->string('name');
            $table->string('phoneNumber')->unique();
            $table->string('idCode')->nullable();
            $table->string('password');
            $table->string('password_confirmation')->nullable();
            $table->string('email');
            $table->string('degree');
            $table->string('degree_image');
            $table->string('license_image');
            $table->string('license_number');
            $table->text('information')->nullable();
            $table->string('national_id_front_side');
            $table->string('national_id_back_side');
            $table->string('Nationality')->nullable();
            $table->boolean('is_active')->default(false);
            $table->boolean('online')->default(false);
            $table->string('speciality')->nullable();
            $table->string('totalRating')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->bigInteger('speciality_id')->unsigned();
            $table->foreign('speciality_id')->references('id')->on('doctor_specailties')->onDelete("cascade");
            $table->boolean('homecare')->default(false);
            $table->boolean('isHospital')->default(false);
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
        Schema::dropIfExists('online_doctors');
    }
}
