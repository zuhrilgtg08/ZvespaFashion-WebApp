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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('alamat')->nullable();
            $table->string('job')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('profile_image')->nullable();
            $table->tinyInteger('roles_type')->default(0);
            $table->foreignId('u_prov_id')->default(0);
            $table->foreignId('u_kota_id')->default(0);
            $table->date('birthday')->nullable();
            $table->string('religion')->nullable();
            $table->string('excerpt')->nullable();
            $table->text('bio_user')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
