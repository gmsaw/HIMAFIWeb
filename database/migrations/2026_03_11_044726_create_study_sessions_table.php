<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('study_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('duration_minutes'); // Menyimpan berapa menit mereka fokus
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('study_sessions');
    }
};