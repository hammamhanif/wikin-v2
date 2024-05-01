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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('news_id');
            $table->unsignedBigInteger('reported_by_user_id');
            $table->unsignedBigInteger('reported_user_id'); // Kolom untuk menyimpan ID pengguna yang membuat berita
            $table->string('description'); // Kolom untuk deskripsi laporan
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('news_id')->references('id')->on('news')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('reported_by_user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('reported_user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade'); // Constraint foreign key untuk kolom reported_user_id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
