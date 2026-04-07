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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel users (Siswa/Peminjam)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Relasi ke tabel books (Buku yang dipinjam)
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade');

            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali'); // Sesuai permintaan (bukan tenggat_kembali)

            // Status menggunakan enum agar data lebih konsisten
            $table->enum('status', ['dipinjam', 'kembali'])->default('dipinjam');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
