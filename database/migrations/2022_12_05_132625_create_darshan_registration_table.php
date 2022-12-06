<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDarshanRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('darshan_registration', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('country_code');
            $table->bigInteger('mobile');
            $table->string('registration_number');
            $table->string('country');
            $table->integer('members');
            $table->string('file')->nullable();
            $table->string('departure_indore');
            $table->string('departure_ujjain');
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
        Schema::dropIfExists('darshan_registration');
    }
}
