<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Add2columToJobCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_cases', function (Blueprint $table) {
            $table->dateTime('cancelTime', 0)->nullable();
            $table->string('note')->nullable();
            $table->integer('cancelBy')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_cases', function (Blueprint $table) {
            $table->dropColumn('cancelTime');
            $table->dropColumn('note');
            $table->dropColumn('cancelBy');
        });
    }
}
