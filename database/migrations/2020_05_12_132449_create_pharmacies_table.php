<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePharmaciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image')->nullable();
            $table->string('pharmacyName')->nullable();
            $table->string('Medical_License_Number')->nullable();
            $table->string('pharmacy_License')->nullable();
            $table->string('countryCode')->nullable();
            $table->string('phoneNumber')->unique()->nullable();
            $table->string('password_confirmation');
            $table->string('idCode')->nullable();
            $table->string('telephone')->nullable();
            $table->string('Hotline')->nullable();
            $table->string('email');
            $table->string('password');
            $table->string('role');
            $table->string('address')->nullable();
            $table->boolean('verify')->default(false);
            $table->boolean('is_active')->default(false);
            $table->boolean('pharmacy_branch')->default(false);
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->boolean('is_faviorate')->default(false);
            $table->string('poients')->default(50);
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
        Schema::dropIfExists('pharmacies');
    }
}
