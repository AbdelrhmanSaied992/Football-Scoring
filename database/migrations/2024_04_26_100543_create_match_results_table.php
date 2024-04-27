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
        Schema::create('match_results', function (Blueprint $table) {
            $table->id();

            $table->foreignId('team_id')->references('id')->on('teams')->onDelete('cascade');

            $table->foreignId('match_scheduling_id')->references('id')->on('match_scheduling')->onDelete('cascade');

            $table->unsignedInteger('score');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_results');
    }
};
