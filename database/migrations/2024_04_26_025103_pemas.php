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
            $table->string('image');
            $table->enum('status', ['sedang berjalan', 'selesai', 'pencarian volunteer'])->default('pencarian volunteer'); // Kolom status dengan nilai default proses
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });


        Schema::create('comments-pemas', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            $table->text('comment-pemas_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pemas_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pemas_id')->references('id')->on('pemas')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
        Schema::create('likes-pemas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pemas_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pemas_id')->references('id')->on('pemas')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes-pemas');
        Schema::dropIfExists('comments-pemas');
        Schema::dropIfExists('pemas');
    }
};
