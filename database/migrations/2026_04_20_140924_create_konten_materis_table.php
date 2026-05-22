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
        Schema::create('konten_materis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('materi_id')->constrained('materis')->onDelete('cascade');
            $table->enum('tipe', ['materi', 'video', 'audio']);
            $table->text('isi')->nullable();
            $table->string('link')->nullable();
            $table->text('deskripsi')->nullable();
            $table->integer('durasi')->nullable();
            $table->integer('urutan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konten_materis');
    }
};
