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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');      // JANGAN 'judul'
            $table->string('author');     // JANGAN 'penulis'
            $table->string('publisher');  // JANGAN 'penerbit'
            $table->integer('year');      // JANGAN 'tahun_terbit'
            $table->integer('stock');     // JANGAN 'stok'
            $table->timestamps();
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
