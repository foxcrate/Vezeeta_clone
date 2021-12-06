<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXraysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xrays', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image')->nullable();
            $table->string('xrayName');
            $table->string('xray_License')->nullable();
            $table->string('Medical_License_Number')->nullable();
            $table->string('totalRating')->nullable();
            $table->string('countryCode')->nullable();
            $table->string('phoneNumber')->unique();
            $table->string('idCode')->nullable();
            $table->string('telephone')->nullable();
            $table->string('password_confirmation');
            $table->string('Hotline')->nullable();
            $table->string('email');
            $table->string('password');
            $table->boolean('is_labs')->default(false);
            $table->string('role');
            $table->string('address')->nullable();
            $table->boolean('verify')->default(false);
            $table->boolean('is_active')->default(false);
            $table->boolean('xray_branch')->default(false);
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->boolean('is_faviorate')->default(false);
            $table->integer('poients')->default(50);
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
        Schema::dropIfExists('xrays');
    }
}
