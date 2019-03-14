<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupervisorTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supervisor_tickets', function (Blueprint $table) {
            $table->unsignedBigInteger('supervisorID');
            $table->foreign('supervisorID')->references('id')->on('supervisors');
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
        Schema::dropIfExists('supervisor_tickets');
    }
}
