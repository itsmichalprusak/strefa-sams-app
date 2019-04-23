<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Employees', function (Blueprint $table) {
            $table->bigIncrements('Id');
            $table->String('Name', 100);
            $table->String('Surname', 100);
            $table->date('LastPromotion')->nullable();
            $table->string('Rank', 8);
            $table->date('BirthDate')->nullable();
            $table->integer('PhoneNumber')->nullable();
            $table->bigInteger('UnderSupervision')->unsigned()->nullable();
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
        Schema::dropIfExists('Employees');
    }
}
