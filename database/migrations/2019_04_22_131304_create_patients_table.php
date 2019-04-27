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
            $table->bigInteger('InsuranceID')->unsigned()->nullable();
            $table->string('Email', 100)->nullable();
            $table->integer('PhoneNumber')->nullable();
            $table->date('BirthDate')->nullable();
            $table->mediumText('Comments')->nullable();
            $table->bigInteger('BloodGroupID')->unsigned()->nullable();
            $table->tinyInteger('Registered')->default('1');
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
