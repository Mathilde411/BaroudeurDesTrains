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
        Schema::create('profile_field_users', function (Blueprint $table) {
            $table->bigInteger('profile_field_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->primary(['profile_field_id', 'user_id']);

            $table->foreign('profile_field_id')->references('id')->on('profile_fields');
            $table->foreign('user_id')->references('id')->on('users');

            $table->text('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_field_users');
    }
};
