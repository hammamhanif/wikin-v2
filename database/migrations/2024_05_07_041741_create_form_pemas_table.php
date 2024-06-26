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
            $table->string('noID')->nullable();
            $table->string('name');
            $table->string('location');
            $table->string('slug')->unique();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->enum('category', ['Umum', 'Kesehatan', 'Energi', 'Industri', 'Pangan']);
            $table->longText('content');
            $table->string('proposal')->nullable();
            $table->enum('status', ['Proses verifikasi', 'Diterima', 'Ditolak'])->default('Proses Verifikasi');
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
