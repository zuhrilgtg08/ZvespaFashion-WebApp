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
        Schema::create('events_web_builder', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pameran');
            $table->string('slug');
            $table->string('photo_pameran')->nullable();
            $table->string('place_event');
            $table->date('begin_event')->nullable();
            $table->longText('description_event');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events_web_builder');
    }
};
