<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInvestigationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('investigation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('manual_entry');
            $table->string('scaned_docs');
            $table->integer('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('patient');
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
