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
        Schema::create('products_vespa', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('name_product');
            $table->integer('stock_product');
            $table->string('nomor_seri')->unique();
            $table->integer('launch_year');
            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->longText('photo_product')->nullable();
            $table->string('thumbnail')->nullable();
            $table->integer('harga_product');
            $table->float('weight_product')->default(0);
            $table->string('excerpt');
            $table->longText('detail_product');
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
        Schema::dropIfExists('products_vespa');
    }
};
