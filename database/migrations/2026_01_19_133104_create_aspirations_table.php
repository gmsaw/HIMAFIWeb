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
    Schema::create('aspirations', function (Blueprint $table) {
        $table->id();
        $table->string('name')->nullable(); // Bisa null jika anonim
        $table->string('email')->nullable();
        $table->string('subject');
        $table->text('message');
        $table->boolean('is_anonymous')->default(false);
        $table->boolean('is_read')->default(false); // Status sudah dibaca admin
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirations');
    }
};
