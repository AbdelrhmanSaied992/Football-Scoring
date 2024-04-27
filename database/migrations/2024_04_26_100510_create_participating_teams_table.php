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
        Schema::create('participating_teams', function (Blueprint $table) {
            $table->id();

            $table->foreignId('team_id')->references('id')->on('teams')->onDelete('cascade');

            $table->foreignId('tournament_id')->references('id')->on('tournaments')->onDelete('cascade');

            $table->string('result');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participating_teams');
    }
};
