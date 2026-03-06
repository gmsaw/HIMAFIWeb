<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('certificates', function (Blueprint $table) {
            // Status: null, 'pending', 'approved', 'rejected'
            $table->string('tte_status')->nullable()->default(null);
            $table->text('tte_note')->nullable(); // Catatan jika ditolak
            $table->timestamp('tte_approved_at')->nullable(); // Waktu disetujui
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('buku_birus', function (Blueprint $table) {
            //
        });
    }
};
