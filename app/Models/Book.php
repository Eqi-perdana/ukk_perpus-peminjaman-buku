<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // Nama tabel (pastikan sesuai di database)
    protected $table = 'books';

    // Kolom yang boleh diisi (Mass Assignable)
    // Sesuaikan dengan nama kolom di PHPMyAdmin kamu
    protected $fillable = [
        'title',
        'author',
        'publisher',
        'year',
        'stock'
    ];
}
