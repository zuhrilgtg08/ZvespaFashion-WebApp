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
        Schema::create('specifications', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('product_id')->references('id')->on('products_vespa')->onDelete('cascade');
            $table->string('engine');
            $table->string('displacement');
            $table->string('max_power');
            $table->string('max_torque');
            $table->string('colling_system');
            $table->string('transmission');
            $table->string('brake_system');
            $table->string('front_tire');
            $table->string('rear_tire');
            $table->string('type_model');
            $table->string('fuel_capacity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specifications');
    }
};
