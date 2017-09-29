<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname',60);
            $table->string('lastname',60);
            $table->string('middlename',60);
            $table->string('address',120);
            $table->integer('country_id')->unsigned();
            $table->foreign('country_id')->reference('id')->on('countries');
            $table->integer('age');
            $table->date('birthdate');
            $table->date('date_hired');
            $table->string('picture');
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
        Schema::dropIfExists('employees');
    }
}
