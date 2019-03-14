<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobSiteSafetyRestrictionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_site_safety_restrictions', function (Blueprint $table) {
            $table->unsignedBigInteger('jobSiteID');
            $table->foreign('jobSiteID')->references('id')->on('job_sites');
            $table->unsignedBigInteger('safetyRestrictionID');
            $table->foreign('safetyRestrictionID')->references('id')->on('safety_restrictions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_site_safety_restrictions');
    }
}
