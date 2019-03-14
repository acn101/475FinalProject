<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequiredCertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('required_certs', function (Blueprint $table) {
            $table->unsignedBigInteger('certificationID');
            $table->foreign('certificationID')->references('id')->on('certifications');
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
        Schema::dropIfExists('required_certs');
    }
}
