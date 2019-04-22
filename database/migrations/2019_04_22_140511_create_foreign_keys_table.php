<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Patients', function (Blueprint $table) {
            $table->foreign('InsuranceID')->references('Id')->on('Insurances');
            $table->foreign('BloodGroupID')->references('Id')->on('BloodGroups');
        });

        //Schema::table('BloodGroups', function (Blueprint $table) {

        //});

        Schema::table('Insurances', function (Blueprint $table) {
            $table->foreign('PatientID')->references('Id')->on('Patients');
            $table->foreign('PersonIssuing')->references('Id')->on('Employees');
        });

        Schema::table('Employees', function (Blueprint $table) {
            $table->foreign('UnderSupervision')->references('Id')->on('employees');
        });

        Schema::table('CardIndexes', function (Blueprint $table) {
            $table->foreign('PatientId')->references('Id')->on('Patients');
            $table->foreign('SupervisingDoctor')->references('Id')->on('Employees');
            $table->foreign('TreatmentCategoryId')->references('Id')->on('Treatments');
        });

        //Schema::table('Treatments', function (Blueprint $table) {

        //});

        Schema::table('AuthorizedPersons', function (Blueprint $table) {
            $table->foreign('PatientID')->references('Id')->on('Patients');
            $table->foreign('AuthorizedPerson')->references('Id')->on('Patients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foreign_keys');
    }
}
