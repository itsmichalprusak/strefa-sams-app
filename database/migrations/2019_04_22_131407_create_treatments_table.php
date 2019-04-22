<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreatmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Treatments', function (Blueprint $table) {
            $table->bigIncrements('Id');
            $table->string('TreatmentCategory', 255);
            $table->integer('UnInsurancePriceMin');
            $table->integer('UnInsurancePriceMax');
            $table->integer('InsurancePriceMin');
            $table->integer('InsurancePriceMax');
            $table->text('Description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Treatments');
    }
}
