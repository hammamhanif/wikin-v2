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
        Schema::create('form_pemas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('noID')->nullable();
            $table->string('nama_kegiatan');
            $table->string('location');
            $table->string('slug')->unique();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('category');
            $table->text('content');
            $table->enum('status', ['Proses verifikasi', 'Diterima', 'Ditolak'])->default('Proses Verifikasi'); // Kolom status 
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_pemas');
    }
};
