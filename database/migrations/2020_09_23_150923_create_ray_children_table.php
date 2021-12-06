<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRayChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ray_children', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ray_name');
            $table->string('date')->nullable();
            $table->string('link')->nullable();
            $table->bigInteger('child_id')->unsigned();
            $table->bigInteger('rocata_child_id')->unsigned()->nullable();
            $table->bigInteger('online_doctor_id')->unsigned();
            $table->foreign('child_id')->references('id')->on('children')->onDelete('cascade');
            $table->foreign('rocata_child_id')->references('id')->on('rocata_children')->onDelete('cascade');
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
        Schema::dropIfExists('ray_children');
    }
}
