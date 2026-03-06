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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('publisher')->nullable();
            $table->year('year');
            $table->string('category'); // Fisika Murni, Terapan, Jurnal, Skripsi
            $table->integer('stock')->default(1);
            $table->string('cover_image')->nullable(); // Foto sampul
            
            // Kolom E-Book
            $table->string('file_path')->nullable(); // Untuk file yang di-upload
            $table->string('file_url')->nullable();  // Untuk link GDrive/Eksternal (Hapus ->after, cukup taruh di bawah file_path)
            
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};