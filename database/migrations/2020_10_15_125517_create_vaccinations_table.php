<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVaccinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaccinations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('at_birth')->nullable();
            $table->longText('two_month')->nullable();
            $table->longText('four_month')->nullable();
            $table->longText('six_month')->nullable();
            $table->longText('nine_month')->nullable();
            $table->longText('twelve_month')->nullable();
            $table->longText('eighteen_month')->nullable();
            $table->longText('twenty_four_month')->nullable();
            $table->bigInteger('child_id')->unsigned();
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
        Schema::dropIfExists('vaccinations');
    }
}
