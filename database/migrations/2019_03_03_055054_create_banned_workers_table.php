<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannedWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banned_workers', function (Blueprint $table) {
            $table->unsignedBigInteger('workerID');
            $table->foreign('workerID')->references('id')->on('workers');
            $table->unsignedBigInteger('companyID');
            $table->foreign('companyID')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banned_workers');
    }
}
