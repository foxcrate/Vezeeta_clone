<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('couples', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patientAccept_id')->unsigned();
            $table->foreign('patientAccept_id')->references('id')->on('patiens')->onDelete('cascade');
            $table->bigInteger('patientRequest_id')->unsigned();
            $table->foreign('patientRequest_id')->references('id')->on('patiens')->onDelete('cascade');
            $table->boolean('couples')->default(false);
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
        Schema::dropIfExists('couples');
    }
}
