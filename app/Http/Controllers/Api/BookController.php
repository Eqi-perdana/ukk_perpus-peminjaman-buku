<?php

namespace App\Http\Controllers\Api;

// TAMBAHKAN BARIS INI untuk memanggil Controller utama
use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

// Sekarang "extends Controller" tidak akan error lagi
class BookController extends Controller
{
    public function index()
    {
        return response()->json(Book::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'     => 'required|string',
            'author'    => 'required|string',
            'publisher' => 'nullable|string',
            'year'      => 'required|integer',
            'stock'     => 'required|integer',
        ]);

        $book = Book::create($validated);
        return response()->json($book, 201);
    }

    public function destroy($id)
    {
        Book::destroy($id);
        return response()->json(['message' => 'Deleted']);
    }
}
