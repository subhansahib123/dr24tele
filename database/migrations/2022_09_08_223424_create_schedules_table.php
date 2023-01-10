<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            // $table->string('slot_id')->nullable();
            $table->date('start_date')->default(null);
            $table->date('end_date')->default(null);
            $table->time('start');
            $table->time('end');
             $table->boolean('repeat')->default(0);
            $table->string('days')->default(null);
             $table->integer('price')->nullable();
             $table->integer('interval')->nullable();
             $table->integer('number_of_people')->nullable();
            $table->string('comment');
            $table->timestamps();
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
          });
    }

    /**
     * Reverse the migrations.
     *
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
