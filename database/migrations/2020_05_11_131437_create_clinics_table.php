<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image')->nullable();
            $table->string('clinicName');
            $table->string('Primary_Speciality')->nullable();
            $table->string('Medical_License_Number');
            $table->string('Clinic_License')->nullable();
            $table->string('countryCode')->nullable();
            $table->string('phoneNumber')->unique();
            $table->string('idCode')->nullable();
            $table->string('telephone')->nullable();
            $table->string('Hotline')->nullable();
            $table->string('email')->nullable();
            $table->string('password');
            $table->string('password_confirmation');
            $table->string('role');
            $table->string('address')->nullable();
            $table->boolean('is_active')->default(false);
            $table->boolean('clinic_labs')->default(false);
            $table->boolean('clinic_xray')->default(false);
            $table->boolean('clinic_pharmacy')->default(false);
            $table->boolean('clinic_branch')->default(false);
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
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
        Schema::dropIfExists('clinics');
    }
}
