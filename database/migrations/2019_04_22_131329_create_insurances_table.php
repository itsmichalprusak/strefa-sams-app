<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Insurances', function (Blueprint $table) {
            $table->bigIncrements('Id');
            $table->bigInteger('PatientId')->unsigned();
            $table->integer('InsuranceAmount');
            $table->date('InsuranceDate');
            $table->bigInteger('PersonIssuing')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Insurances');
    }
}
