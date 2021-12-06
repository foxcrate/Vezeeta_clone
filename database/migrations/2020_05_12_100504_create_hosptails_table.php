<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHosptailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hosptails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image')->nullable();
            $table->string('hosptailName')->unique();
            $table->string('Primary_Speciality')->default('f');
            $table->string('Medical_License_Number')->default('f');
            $table->string('Hosptail_License')->default('f.jpg');
            $table->string('countryCode')->default('f');
            $table->string('phoneNumber')->default('f');
            $table->string('idCode')->default('f');
            $table->string('telephone')->default('f');
            $table->string('Hotline')->default('f');
            $table->string('email')->nullable();
            $table->string('password');
            $table->string('password_confirmation');
            $table->string('role');
            $table->string('address')->default('f');
            $table->boolean('is_active')->default(false);
            $table->boolean('hosptail_labs')->default(false);
            $table->boolean('hosptail_xray')->default(false);
            $table->boolean('hosptail_pharmacy')->default(false);
            $table->boolean('hosptail_branch')->default(false);
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->boolean('poients')->default(50);
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
        Schema::dropIfExists('hosptails');
    }
}
