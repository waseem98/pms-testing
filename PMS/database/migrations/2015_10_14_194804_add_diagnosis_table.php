<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDiagnosisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnosis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('disease');
            $table->string('treatment');
            $table->string('g_report');
            $table->string('clinical_info');
            $table->integer('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('patient');
            $table->date('next_visit');
            $table->date('date');
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
        //
    }
}
