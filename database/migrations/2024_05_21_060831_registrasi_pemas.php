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
        Schema::create('registrasi_pemas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pemas_id');
            $table->string('judul');
            $table->string('nama');
            $table->string('noID');
            $table->string('alamat');
            $table->enum('program_study', ['Elektronika Instrumentasi', 'Teknokimia Nuklir', 'Elektro Mekanika']);
            $table->enum('type', ['dosen', 'mahasiswa', 'lainnya']);
            $table->enum('status', ['Proses verifikasi', 'Diterima', 'Ditolak'])->default('Proses Verifikasi'); // Kolom status 
            $table->text('motivasi');
            $table->timestamps();

            // Membuat foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pemas_id')->references('id')->on('pemas')->onDelete('cascade')->onUpdate('cascade');

            // Membuat unique constraint untuk memastikan user hanya bisa mendaftarkan satu pemas sekali
            $table->unique(['user_id', 'pemas_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('RegistrasiPemas');
    }
};
