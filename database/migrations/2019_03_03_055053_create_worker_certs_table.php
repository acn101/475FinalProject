<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkerCertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_certs', function (Blueprint $table) {
            $table->unsignedBigInteger('certificationID');
            $table->foreign('certificationID')->references('id')->on('certifications');
            $table->unsignedBigInteger('workerID');
            $table->foreign('workerID')->references('id')->on('workers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('worker_certs');
    }
}
