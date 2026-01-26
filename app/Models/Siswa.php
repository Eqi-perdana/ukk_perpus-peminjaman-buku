<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswas'; // TAMBAHKAN INI (AMAN)

    protected $fillable = [
        'nis',
        'nama',
        'kelas',
        'jenis_kelamin',
    ];
}
