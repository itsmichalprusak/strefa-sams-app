<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorizedPersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('AuthorizedPersons', function (Blueprint $table) {
            $table->bigIncrements('Id');
            $table->bigInteger('PatientId')->unsigned();
            $table->bigInteger('AuthorizedPerson')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('AuthorizedPersons');
    }
}
