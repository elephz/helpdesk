<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWageToJobCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_cases', function (Blueprint $table) {
            $table->double('wage')->default(0)->after('jobStatus');
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
            $table->dropColumn('wage');
        });
    }
}
