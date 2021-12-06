<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nurses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image')->default('default.jpg');
            $table->string('name');
            $table->string('phoneNumber')->unique();
            $table->string('countryCode')->nullable();
            $table->string('idCode');
            $table->string('email');
            $table->string('gender');
            $table->string('address');
            $table->string('password');
            $table->text('information');
            $table->string('national_id_front_side');
            $table->string('national_id_back_side');
            $table->string('national_id')->nullable();
            $table->string('Nationality')->nullable();
            $table->boolean('is_active')->nullable();
            $table->boolean('online')->default(true);
            $table->integer('poients')->default(50);
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
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
        Schema::dropIfExists('nurses');
    }
}
