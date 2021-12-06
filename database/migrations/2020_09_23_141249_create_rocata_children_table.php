<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRocataChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rocata_children', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('prescription')->nullable();
            $table->string('date')->nullable();
            $table->string('jaw_type')->nullable();
            $table->string('jaw_direction')->nullable();
            $table->string('teeth_type')->nullable();
            $table->string('eye_type')->nullable();
            $table->text('medication')->nullable();
            $table->bigInteger('child_id')->unsigned();
            $table->bigInteger('online_doctor_id')->unsigned();
            $table->foreign('child_id')->references('id')->on('children')->onDelete('cascade');
            $table->foreign('online_doctor_id')->references('id')->on('online_doctors')->onDelete('cascade');
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
        Schema::dropIfExists('rocata_children');
    }
}
