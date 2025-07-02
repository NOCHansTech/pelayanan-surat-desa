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
        Schema::create('surat_pengajuan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_residents')->constrained('residents', 'id')->onDelete('cascade');
            $table->foreignId('id_jenis_surat')->constrained('jenis_surat', 'id')->onDelete('cascade');
            $table->string('nomor_surat', 50)->nullable();
            $table->date('tanggal_pengajuan');
            $table->date('tanggal_disetujui')->nullable();
            $table->enum('status', ['diajukan', 'diproses', 'ditolak', 'selesai'])->default('diajukan');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_pengajuans');
    }
};
