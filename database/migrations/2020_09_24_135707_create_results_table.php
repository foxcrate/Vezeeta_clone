<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('test_id')->unsigned()->nullable();
            $table->bigInteger('ray_id')->unsigned()->nullable();
            $table->bigInteger('patien_id')->unsigned()->nullable();
            $table->bigInteger('test_child_id')->unsigned()->nullable();
            $table->bigInteger('ray_child_id')->unsigned()->nullable();
            $table->bigInteger('child_id')->unsigned()->nullable();
            $table->foreign('test_id')->references('id')->on('patient_analzes')->onDelete('cascade');
            $table->foreign('ray_id')->references('id')->on('patient_rays')->onDelete('cascade');
            $table->foreign('patien_id')->references('id')->on('patiens')->onDelete('cascade');
            $table->foreign('test_child_id')->references('id')->on('test_children')->onDelete('cascade');
            $table->foreign('ray_child_id')->references('id')->on('ray_children')->onDelete('cascade');
            $table->foreign('child_id')->references('id')->on('children')->onDelete('cascade');
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
        Schema::dropIfExists('results');
    }
}
