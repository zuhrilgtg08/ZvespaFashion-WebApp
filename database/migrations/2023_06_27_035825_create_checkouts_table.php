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
            $table->float('total_berat');
            $table->integer('harga_ongkir');
            $table->string('layanan_ongkir');
            $table->integer('total_amount');
            $table->string('alamat');
            $table->string('status_pengiriman')->default('menunggu_pembayaran');
            $table->string('link_pdf')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('transaction_status')->nullable();
            $table->date('transaction_time')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('snap_token', 36)->nullable();
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
