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
        Schema::create('pemas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('category', ['Umum', 'Kesehatan', 'Energi', 'Industri', 'Pangan']);
            $table->string('location');
            $table->longText('content');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->string('lpj')->nullable();
            $table->enum('status_pemas', ['pengajuan', 'sedang berjalan', 'selesai', 'pencarian volunteer'])->default('pengajuan'); // Kolom status dengan nilai default proses
            $table->enum('status', ['Proses verifikasi', 'Diterima', 'Ditolak'])->default('Proses Verifikasi'); // Kolom status dengan nilai default proses
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });


        Schema::create('comment_pemas', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            $table->text('comment_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pemas_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pemas_id')->references('id')->on('pemas')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
        Schema::create('likes_pemas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('comment_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('comment_id')->references('id')->on('comment_pemas')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes_pemas');
        Schema::dropIfExists('comment_pemas');
        Schema::dropIfExists('pemas');
    }
};
