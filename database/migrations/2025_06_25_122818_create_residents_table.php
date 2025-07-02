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
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable()->constrained('users', 'id_users')->onDelete('cascade');
            $table->string('nik', 16)->unique();
            $table->string('nama_lengkap', 100);
            $table->string('tempat_lahir', 50)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('alamat')->nullable();
            $table->string('agama', 50)->nullable();
            $table->string('status_perkawinan', 50)->nullable();
            $table->string('pekerjaan', 100)->nullable();
            $table->string('kewarganegaraan', 50)->nullable();
            $table->string('nama_ayah', 100)->nullable();
            $table->string('nama_ibu', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};
