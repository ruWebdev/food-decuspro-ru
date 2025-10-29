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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('photo_path')->nullable();
            $table->string('video_url')->nullable();
            $table->string('description', 500)->nullable();
            $table->unsignedSmallInteger('servings');
            $table->enum('difficulty', ['easy', 'medium', 'hard']);
            $table->foreignId('cuisine_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->unsignedSmallInteger('active_time');
            $table->unsignedSmallInteger('total_time');
            $table->unsignedSmallInteger('calories')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
