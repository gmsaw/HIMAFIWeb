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
        // 1. Tabel Users
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            
            // Data Standar
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            
            // --- DATA TAMBAHAN (HIMAFI) ---
            $table->string('nim')->unique()->nullable(); // Nullable agar 'eksternal' bisa daftar tanpa NIM
            $table->string('angkatan')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('ktm_path')->nullable(); // Menyimpan path file gambar/pdf KTM
            
            // --- ROLE & STATUS ---
            // Enum Role sesuai permintaan
            $table->enum('role', [
                'admin', 
                'sekretaris', 
                'bendahara', 
                'anggota', 
                'mahasiswa', 
                'eksternal'
            ])->default('mahasiswa');
            
            // Status Validasi Admin (Default False = Belum disetujui)
            $table->boolean('is_approved')->default(false);
            
            $table->rememberToken();
            $table->timestamps();
        });

        // 2. Tabel Password Reset Tokens (Bawaan Laravel)
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // 3. Tabel Sessions (Bawaan Laravel)
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};