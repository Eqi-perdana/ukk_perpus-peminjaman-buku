<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        // Kita ambil semua dan mapping agar key JSON sesuai dengan yang diminta React (Frontend)
        $books = Book::all()->map(function ($b) {
            return [
                'id'        => $b->id_buku, // Primary key di DB
                'title'     => $b->judul_buku,
                'author'    => $b->penulis,
                'publisher' => $b->penerbit,
                'year'      => $b->tahun_terbit,
                'stock'     => $b->stock,
            ];
        });

        return response()->json($books);
    }

    public function store(Request $request)
    {
        // Cek apakah data masuk dengan benar
        // return $request->all(); // <--- Hapus komentar ini untuk tes di Postman/Browser jika ragu

        $validated = $request->validate([
            'title'     => 'required',
            'author'    => 'required',
            'publisher' => 'required',
            'year'      => 'required|numeric',
            'stock'     => 'required|numeric',
        ]);

        return Book::create($validated);
    }

    public function show($id)
    {
        // Gunakan findOrFail agar jika tidak ada, return 404 otomatis
        $book = Book::where('id_buku', $id)->firstOrFail();
        return response()->json($book);
    }

    public function update(Request $request, $id)
    {
        // Cari berdasarkan id_buku
        $book = Book::where('id_buku', $id)->firstOrFail();

        $data = $request->validate([
            'title'     => 'required|string|max:255',
            'author'    => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'year'      => 'required|numeric',
            'stock'     => 'required|numeric',
        ]);

        $book->update([
            'judul_buku'   => $data['title'],
            'penulis'      => $data['author'],
            'penerbit'     => $data['publisher'],
            'tahun_terbit' => $data['year'],
            'stock'        => $data['stock'],
        ]);

        return response()->json($book);
    }

    public function destroy($id)
    {
        // Hapus berdasarkan id_buku
        $book = Book::where('id_buku', $id)->firstOrFail();
        $book->delete();

        return response()->json(['message' => 'Buku berhasil dihapus']);
    }
}
