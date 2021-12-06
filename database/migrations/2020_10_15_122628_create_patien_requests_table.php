<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatienRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patien_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patient_id')->unsigned();
            $table->bigInteger('doctor_id')->unsigned()->nullable();
            $table->bigInteger('nurse_id')->unsigned()->nullable();
            $table->bigInteger('chat_id')->unsigned();
            $table->boolean('is_accept')->default(false);
            $table->foreign('patient_id')->references('id')->on('patiens')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('online_doctors')->onDelete('cascade');
            $table->foreign('nurse_id')->references('id')->on('nurses')->onDelete('cascade');
            $table->foreign('chat_id')->references('id')->on('chats')->onDelete('cascade');
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
        Schema::dropIfExists('patien_requests');
    }
}
