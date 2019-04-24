<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardIndexesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CardIndexes', function (Blueprint $table) {
            $table->bigIncrements('Id');
            $table->bigInteger('PatientId')->unsigned();
            $table->string('Annotation', 8)->nullable();
            $table->date('Date');
            $table->bigInteger('SupervisingDoctor')->unsigned();
            $table->bigInteger('TreatmentCategoryId')->unsigned();
            $table->integer('Price');
            $table->boolean('IsPaid');
            $table->mediumText('Recognition')->nullable();
            $table->mediumText('Treatment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('CardIndexes');
    }
}
