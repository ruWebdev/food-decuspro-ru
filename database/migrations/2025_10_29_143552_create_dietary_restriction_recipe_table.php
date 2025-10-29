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
        Schema::create('dietary_restriction_recipe', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('dietary_restriction_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->timestamps();
            $table->unique(['recipe_id', 'dietary_restriction_id'], 'dietary_recipe_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dietary_restriction_recipe');
    }
};
