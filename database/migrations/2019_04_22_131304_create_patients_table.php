<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Patients', function (Blueprint $table) {
            $table->bigIncrements('Id');
            $table->string('Name', 100);
            $table->string('Surname', 100);
            $table->boolean('IsInsured');
            $table->bigInteger('InsuranceID')->unsigned();
            $table->string('Email', 100);
            $table->integer('PhoneNumber');
            $table->date('BirthDate');
            $table->mediumText('Comments');
            $table->bigInteger('BloodGroupID')->unsigned();
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
        Schema::dropIfExists('Patients');
    }
}
