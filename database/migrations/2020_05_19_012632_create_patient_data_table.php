<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('width')->nullable()->default(10);
            $table->string('height')->nullable();
            $table->string('width_type')->nullable();
            $table->string('blood')->nullable();
            $table->text('agree_name')->nullable();
            $table->text('allergi_data')->nullable();
            $table->text('surgery_data')->nullable();
            $table->text('medication_name')->nullable();
            $table->text('rocata_file')->nullable();
            $table->text('rays_file')->nullable();
            $table->text('analzes_file')->nullable();
            $table->integer('colonscopy')->default(2)->nullable();
            $table->date('colonscopy_data')->nullable();
            $table->integer('mammogram')->default(4)->nullable();
            $table->date('mammogram_data')->nullable();
            $table->integer('prc')->default(6)->nullable();
            $table->date('prc_data')->nullable();
            $table->text('smoking')->nullable();
            // $table->string('cigarette')->nullable();
            // $table->string('drug')->nullable();
            $table->string('mother')->nullable();
            $table->string('other_mother')->nullable();
            $table->string('father')->nullable();
            $table->string('other_father')->nullable();
            $table->string('wife_Period_Cycle')->nullable();
            $table->string('wife_Abotion')->nullable();
            $table->string('wife_Contraceptive')->nullable();
            $table->string('mother_Period_Cycle')->nullable();
            $table->string('mother_pregnency')->nullable();
            $table->string('mother_abotion')->nullable();
            $table->string('mother_deliveries')->nullable();
            $table->string('mother_complicetion')->nullable();
            $table->string('mother_Contraceptive')->nullable();
            $table->string('single_Period_Cycle')->nullable();
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
        Schema::dropIfExists('patient_data');
    }
}
