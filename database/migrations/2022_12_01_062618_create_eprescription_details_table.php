<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEprescriptionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eprescription_details', function (Blueprint $table) {
            $table->id();
            $table->string('medicine');
            $table->string('morning')->default(0);
            $table->string('after_noon')->default(0);
            $table->string('evening')->default(0);
            $table->string('comment')->nullable();
            $table->unsignedBigInteger('eprescription_id');
            $table->foreign('eprescription_id')->references('id')->on('eprescriptions');
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
        Schema::dropIfExists('eprescription_details');
    }
}
