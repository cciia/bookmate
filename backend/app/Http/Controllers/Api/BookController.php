<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            Book::with(['author', 'publisher', 'category', 'shelf'])->latest()->paginate(10)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'isbn' => 'required|unique:books',
            'title' => 'required|max:255',
            'author_id' => 'required',
            'publisher_id' => 'required',
            'category_id' => 'required',
            'shelf_id' => 'required'
        ]);
        $lastBook = Book::latest('id')->first();
        $number = ($lastBook && $lastBook->code)
            ? intval(substr($lastBook->code, 2)) + 1: 1;
        $code = 'BK' . str_pad($number, 5, '0', STR_PAD_LEFT);
        $book = Book::create([
            'code' => $code,
            'isbn' => $request->isbn,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'author_id' => $request->author_id,
            'publisher_id' => $request->publisher_id,
            'category_id' => $request->category_id,
            'shelf_id' => $request->shelf_id,
            'genre' => $request->genre,
            'publication_year' => $request->publication_year,
            'edition' => $request->edition,
            'total_pages' => $request->total_pages,
            'language' => $request->language ?? 'Indonesia',
            'synopsis' => $request->synopsis,
            'cover' => $request->cover,
            'is_active' => true
        ]);

        return response()->json(['message' => 'Buku berhasil ditambahkan', 'data' => $book], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(
            Book::with([
                'author',
                'publisher',
                'category',
                'shelf'
            ])->findOrFail($id)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'isbn' => 'required|unique:books,isbn,' . $id,
            'title' => 'required|max:255',
            'author_id' => 'required',
            'publisher_id' => 'required',
            'category_id' => 'required',
            'shelf_id' => 'required'
        ]);
        $book = Book::findOrFail($id);
        $book->update([
            'isbn' => $request->isbn,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'author_id' => $request->author_id,
            'publisher_id' => $request->publisher_id,
            'category_id' => $request->category_id,
            'shelf_id' => $request->shelf_id,
            'genre' => $request->genre,
            'publication_year' => $request->publication_year,
            'edition' => $request->edition,
            'total_pages' => $request->total_pages,
            'language' => $request->language,
            'synopsis' => $request->synopsis,
            'cover' => $request->cover,
            'is_active' => $request->is_active
        ]);

        return response()->json(['message' => 'Buku berhasil diperbarui','data' => $book]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::findOrFail($id)->delete();
        return response()->json([
            'message' => 'Buku berhasil dihapus'
        ]);
    }
}
