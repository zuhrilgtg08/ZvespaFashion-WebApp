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
        Schema::create('articel_web_builder', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('user_id');
            $table->foreignId('category_id');
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->longText('content');
            $table->string('thumbnail')->nullable();
            $table->string('photo_articel')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articel_web_builder');
    }
};
