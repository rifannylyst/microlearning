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
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('materi_id')->constrained('materis')->onDelete('cascade');
            $table->enum('tipe', ['materi', 'video', 'audio']);
            $table->enum('status', ['belum_dimulai', 'sedang_dikerjakan', 'selesai'])->default('belum_dimulai');
            $table->integer('persentase')->default(0);
            $table->datetime('last_accessed')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};
