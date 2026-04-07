<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaksi; // Pastikan nama model sudah sesuai
use App\Models\Book;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Menampilkan semua data transaksi
     */
    public function getTransaksi()
    {
        // Mengambil data transaksi beserta relasi user dan buku (Eager Loading)
        $data = Transaksi::with(['user', 'book'])->latest()->get();
        return response()->json($data);
    }

    /**
     * Menyimpan transaksi peminjaman baru
     */
    public function storeTransaksi(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'tanggal_kembali' => 'required|date|after_or_equal:today',
        ]);

        // 2. Cek stok buku
        $book = Book::find($request->book_id);
        if (!$book || $book->stok <= 0) {
            return response()->json([
                'message' => 'Gagal! Stok buku habis atau buku tidak ditemukan.'
            ], 400);
        }

        // 3. Simpan data transaksi
        $transaksi = Transaksi::create([
            'user_id'         => $request->user_id,
            'book_id'         => $request->book_id,
            'tanggal_pinjam'  => Carbon::now()->toDateString(),
            'tanggal_kembali' => $request->tanggal_kembali,
            'status'          => 'dipinjam',
        ]);

        // 4. Kurangi stok buku secara otomatis
        $book->decrement('stok');

        return response()->json([
            'message' => 'Transaksi berhasil dicatat!',
            'data'    => $transaksi->load(['user', 'book']) // Load relasi untuk respon
        ], 201);
    }

    /**
     * Memproses pengembalian buku (Selesai Transaksi)
     */
    public function selesaiTransaksi($id)
    {
        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            return response()->json(['message' => 'Transaksi tidak ditemukan!'], 404);
        }

        if ($transaksi->status === 'kembali') {
            return response()->json(['message' => 'Buku ini sudah dikembalikan sebelumnya.'], 400);
        }

        // 1. Update status transaksi
        $transaksi->update([
            'status' => 'kembali'
        ]);

        // 2. Kembalikan stok buku
        $book = Book::find($transaksi->book_id);
        if ($book) {
            $book->increment('stok');
        }

        return response()->json([
            'message' => 'Buku berhasil dikembalikan, transaksi selesai!'
        ]);
    }
}
