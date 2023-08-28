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
            $table->string('photo_product')->nullable();
            $table->string('thumbnail')->nullable();
            $table->integer('harga_product');
            $table->string('excerpt');
            $table->longText('detail_product');
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
