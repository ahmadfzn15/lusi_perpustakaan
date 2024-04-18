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
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->string('cover')->nullable();
            $table->string('judul_buku');
            $table->string('penulis');
            $table->string('penerbit');
            $table->integer('jumlah_halaman')->nullable();
            $table->text('sinopsis')->nullable();
            $table->integer('stok');
            $table->foreignId('id_kategori')->constrained('kategori');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
