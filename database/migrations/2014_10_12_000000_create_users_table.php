<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // Replace Nullable with Unique from here 
            $table->string('username')->nullable(); 
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            // To here
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('uuid')->nullable();
            $table->string('PersonId')->nullable();
            $table->boolean('status');
            $table->rememberToken();
            $table->timestamps();
            $table->unsignedBigInteger('profession_id')->nullable();
            $table->foreign('profession_id')->references('id')->on('professions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
