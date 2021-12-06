<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('child_name')->nullable();
            $table->string('image')->nullable();
            $table->string('birthDay')->nullable();
            $table->string('gender')->nullable();
            $table->string('weight')->nullable();
            $table->string('weight_type')->nullable();
            $table->string('height')->nullable();
            $table->string('blood')->nullable();
            $table->text('disease')->nullable();
            $table->text('Surgeries')->nullable();
            $table->text('allergy')->nullable();
            $table->text('medication')->nullable();
            $table->text('fatherdisease')->nullable();
            $table->text('motherdisease')->nullable();
            $table->bigInteger('patient_id')->unsigned();

            $table->foreign('patient_id')->references('id')->on('patiens')->onDelete('cascade');
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
        Schema::dropIfExists('children');
    }
}
