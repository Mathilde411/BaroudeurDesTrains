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
        Schema::create('conversation_users', function (Blueprint $table) {
            $table->bigInteger('conversation_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->primary(['conversation_id', 'user_id']);

            $table->foreign('conversation_id')->references('id')->on('conversations');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversation_users');
    }
};
