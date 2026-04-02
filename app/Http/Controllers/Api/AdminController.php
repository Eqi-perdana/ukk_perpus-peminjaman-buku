<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function chart()
    {
        // Statistik per bulan
        $monthly = Peminjaman::selectRaw('
                MONTH(tanggal_pinjam) as bulan,
                COUNT(*) as total
            ')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Statistik berdasarkan status
        $status = Peminjaman::selectRaw('
                status,
                COUNT(*) as total
            ')
            ->groupBy('status')
            ->get();

        return response()->json([
            'monthly' => $monthly,
            'status'  => $status
        ]);
    }
}
