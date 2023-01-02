<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('displayname')->nullable();
            $table->string('contactperson_designation')->nullable();
            $table->string('contactperson')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->boolean('featured_status')->default(0);
            $table->string('email')->nullable();
            $table->string('building')->nullable();
            $table->string('district')->nullable();
            $table->string('postalCode')->nullable();
            $table->string('slug');
            $table->string('image')->nullable();
            $table->string('level')->nullable();
            $table->string('uuid')->nullable();
            $table->string('status')->default('Disabled');
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
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
        Schema::dropIfExists('organizations');
    }
}
