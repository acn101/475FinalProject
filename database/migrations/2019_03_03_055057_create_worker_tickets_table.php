<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkerTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_tickets', function (Blueprint $table) {
            $table->unsignedBigInteger('workerID');
            $table->foreign('workerID')->references('id')->on('workers');
            $table->unsignedBigInteger('workOrderID');
            $table->foreign('workOrderID')->references('id')->on('work_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('worker_tickets');
    }
}
