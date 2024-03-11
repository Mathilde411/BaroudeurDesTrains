<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('success_users', function (Blueprint $table) {
            $table->bigInteger('success_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->primary(['success_id', 'user_id']);

            $table->foreign('success_id')->references('id')->on('successes');
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('success_users');
    }
};
