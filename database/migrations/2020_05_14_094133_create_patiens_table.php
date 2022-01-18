<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patiens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image')->default('https://phistory.life/uploads/1618227112.png')->nullable();
            $table->string('firstName')->nullable();
            $table->string('middleName')->nullable();
            $table->string('lastName')->nullable();
            $table->string('name')->nullable()->after('lastName');
            $table->string('BirthDate')->nullable();
            $table->string('gender')->nullable();
            $table->string('email')->nullable();
            $table->string('countryCode')->nullable();
            $table->string('phoneNumber')->unique();
            $table->string('phoneNumberReal')->nullable();
            $table->string('idCode')->nullable();
            $table->string('password');
            $table->string('password_confirmation');
            $table->string('state')->nullable();
            $table->string('country')->default('Egypt');
            $table->string('job')->nullable();
            $table->string('race')->nullable();
            $table->string('address')->nullable();
            $table->string('role')->default('patient');
            $table->bigInteger('hosptail_id')->unsigned()->nullable();
            $table->foreign('hosptail_id')->references('id')->on('hosptails')->onDelete('cascade');
            $table->bigInteger('xray_id')->unsigned()->nullable();
            $table->foreign('xray_id')->references('id')->on('xrays')->onDelete('cascade');
            $table->bigInteger('lab_id')->unsigned()->nullable();
            $table->foreign('lab_id')->references('id')->on('labs')->onDelete('cascade');
            $table->bigInteger('pharmacy_id')->unsigned()->nullable();
            $table->foreign('pharmacy_id')->references('id')->on('pharmacies')->onDelete('cascade');
            $table->bigInteger('clinic_id')->unsigned()->nullable();
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
            $table->bigInteger('branch_id')->unsigned()->nullable();
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->boolean('verify')->default(false);
            $table->boolean('is_donor')->default(false);
            $table->boolean('is_active')->default(false);
            $table->boolean('online')->default(false);
            $table->integer('poients')->default(50);
            $table->string('longitude')->after('latitude')->nullable();
            $table->string('latitude')->after('online')->nullable();
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
        Schema::dropIfExists('patiens');
    }
}
