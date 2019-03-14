<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50);
            $table->string('description', 100);
            $table->time('startTime');
            $table->time('endTime');
            $table->date('startDate');
            $table->date('endDate');
            $table->integer('demandPlaced');
            $table->integer('demandFilled');
            $table->integer('payRate');
            $table->boolean('isActive');
            $table->unsignedBigInteger('jobSiteID');
            $table->foreign('jobSiteID')->references('id')->on('job_sites');
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
        Schema::dropIfExists('work_orders');
    }
}
