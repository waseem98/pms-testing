<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeleteForiengKeyCascadeXrays extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('xrays', function (Blueprint $table) {
            $table->dropForeign('xrays_patient_id_foreign');
            $table->foreign('patient_id')
           ->references('id')->on('patient')
           ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('xrays', function (Blueprint $table) {
            //
        });
    }
}
