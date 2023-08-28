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
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('province_id')->constrained('provinces')->onDelete('restrict');
            $table->foreignId('destination_id')->constrained('cities')->onDelete('restrict');
            $table->string('courier');
            $table->float('weight');
            $table->integer('harga_ongkir');
            $table->string('layanan_ongkir');
            $table->integer('total_amount');
            $table->string('alamat');
            $table->string('payment_status')->nullable();
            $table->string('status_pengiriman')->nullable();
            $table->string('payment_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkouts');
    }
};
