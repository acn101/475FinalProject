<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVerifiedHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verified_hours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('workerID');
            $table->foreign('workerID')->references('id')->on('workers');
            $table->unsignedBigInteger('workOrderID');
            $table->foreign('workOrderID')->references('id')->on('work_orders');
            $table->integer('hoursWorked');
            $table->integer('hoursPaid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verified_hours');
    }
}
