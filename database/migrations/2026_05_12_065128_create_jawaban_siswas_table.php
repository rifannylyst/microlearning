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
        Schema::create('jawaban_siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
            $table->foreignId('pertanyaan_id')->constrained('pertanyaans')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('pilihan_jawaban_id')->nullable()->constrained('jawabans')->nullOnDelete();
            $table->text('isian_jawaban')->nullable();
            $table->boolean('is_benar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_siswas');
    }
};
