<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_cases', function (Blueprint $table) {
            $table->id();
            $table->integer('caseTypeId');
            $table->integer('userId');
            $table->integer('techId');
            $table->string('image');
            $table->string('Latitude')->nullable();
            $table->string('Longitude')->nullable();
            $table->longText('caseDetail');
            $table->longText('address');
            $table->dateTime('acceptTime', 0)->nullable();
            $table->dateTime('successTime', 0)->nullable();
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
        Schema::dropIfExists('job_cases');
    }
}
