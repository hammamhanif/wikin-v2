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
        Schema::create('landings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('video')->nullable(); // Kolom untuk video halaman utama
            $table->string('location')->nullable(); // Kolom untuk lokasi
            $table->string('telp')->nullable(); // Kolom untuk telepon
            $table->string('email')->nullable(); // Kolom untuk email
            $table->string('instagram')->nullable(); // Kolom untuk Instagram
            $table->string('question1')->nullable(); // Kolom untuk pertanyaan 1
            $table->text('answer1')->nullable(); // Kolom untuk jawaban pertanyaan 1
            $table->string('question2')->nullable(); // Kolom untuk pertanyaan 2
            $table->text('answer2')->nullable(); // Kolom untuk jawaban pertanyaan 2
            $table->string('question3')->nullable(); // Kolom untuk pertanyaan 3
            $table->text('answer3')->nullable(); // Kolom untuk jawaban pertanyaan 3
            $table->string('question4')->nullable(); // Kolom untuk pertanyaan 4
            $table->text('answer4')->nullable(); // Kolom untuk jawaban pertanyaan 4
            $table->string('question5')->nullable(); // Kolom untuk pertanyaan 5
            $table->text('answer5')->nullable(); // Kolom untuk jawaban pertanyaan 5
            $table->text('youtube1')->nullable(); // Kolom untuk jawaban pertanyaan 5
            $table->text('youtube2')->nullable(); // Kolom untuk jawaban pertanyaan 5
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landings');
    }
};
