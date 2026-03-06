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
    Schema::create('inventories', function (Blueprint $table) {
        $table->id();
        $table->string('code')->unique(); // Kode Barang (misal: INV-001)
        $table->string('name');
        $table->string('category'); // Elektronik, Furniture, ATK, dll
        $table->integer('quantity')->default(0);
        $table->string('condition'); // Baik, Rusak Ringan, Rusak Berat
        $table->string('status')->default('available'); // available, borrowed
        $table->text('description')->nullable();
        $table->string('image')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
