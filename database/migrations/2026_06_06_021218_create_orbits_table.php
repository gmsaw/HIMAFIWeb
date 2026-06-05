<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orbits', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_surat', ['masuk', 'keluar']);
            $table->string('nomor_surat')->unique(); // Mencegah nomor surat ganda
            $table->date('tanggal_surat');
            $table->string('pengirim');
            $table->string('penerima');
            $table->string('perihal');
            $table->string('file_surat'); // Path untuk file PDF
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orbits');
    }
};