<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all()->map(function ($b) {
            return [
                'id' => $b->id_buku,
                'title' => $b->judul_buku,
                'author' => $b->penulis,
                'publisher' => $b->penerbit,
                'year' => $b->tahun_terbit,
                'stock' => $b->stock,
            ];
        });

        return response()->json($books);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'nullable',
            'year' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        $book = Book::create([
            'judul_buku' => $data['title'],
            'penulis' => $data['author'],
            'penerbit' => $data['publisher'],
            'tahun_terbit' => $data['year'],
            'stock' => $data['stock'],
        ]);

        return response()->json($book, 201);
    }

    public function show($id)
    {
        return response()->json(Book::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $data = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'nullable',
            'year' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        $book->update([
            'judul_buku' => $data['title'],
            'penulis' => $data['author'],
            'penerbit' => $data['publisher'],
            'tahun_terbit' => $data['year'],
            'stock' => $data['stock'],
        ]);

        return response()->json($book);
    }

    public function destroy($id)
    {
        Book::destroy($id);
        return response()->json(['message' => 'Deleted']);
    }
}
