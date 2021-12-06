<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image')->nullable();
            $table->string('labsName')->nullable();
            $table->string('Medical_License_Number')->nullable();
            $table->string('labs_License')->nullable();
            $table->string('totalRating')->nullable();
            $table->string('countryCode')->nullable();
            $table->string('phoneNumber')->unique()->nullable();
            $table->string('password_confirmation')->nullable();
            $table->string('idCode')->nullable();
            $table->string('telephone')->nullable();
            $table->string('Hotline')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->boolean('is_xray')->default(false);
            $table->string('role')->nullable();
            $table->string('address')->nullable();
            $table->boolean('verify')->default(false);
            $table->boolean('is_active')->default(false);
            $table->boolean('labs_branch')->default(false);
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('point')->default(50)->nullable();
            $table->boolean('is_faviorate')->default(false);
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
        Schema::dropIfExists('labs');
    }
}
