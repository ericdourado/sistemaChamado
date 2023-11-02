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
        Schema::create('situation', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->timestamps();
        });
        Schema::table('tickets', function (Blueprint $table) {
            $table->foreign('situation')->references('id')->on('situation')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('situations');
    }
};
