<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Nama tabel jika kamu tidak menggunakan nama jamak (plural) otomatis
    protected $table = 'transaksis';

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'user_id',
        'book_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Buku
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
