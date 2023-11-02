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
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
        Schema::table('tickets', function (Blueprint $table) {
            // $table->unsignedBigInteger('user_id');
            // $table->unsignedBigInteger('problem_id');
            // $table->unsignedBigInteger('suport_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('problem_id')->references('id')->on('problem')->onDelete('cascade');
            $table->foreign('suport_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
