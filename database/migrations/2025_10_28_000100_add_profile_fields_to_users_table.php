<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('mobile_phone')->nullable()->after('email');
            $table->string('country')->nullable()->after('mobile_phone');
            $table->string('city')->nullable()->after('country');
            $table->string('vk_id')->nullable()->after('city');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['mobile_phone', 'country', 'city', 'vk_id']);
        });
    }
};
