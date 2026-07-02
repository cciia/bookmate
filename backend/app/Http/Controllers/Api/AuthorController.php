<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Support\Str;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            Author::latest()->get()
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
            'name' => 'required|max:255',
        ]);
        //kode
        $lastAuthor = Author::latest('id')->first();
        $number = $lastAuthor
            ? intval(substr($lastAuthor->code, 4)) + 1 : 1;
        $code = 'AUTH' . str_pad($number, 5, '0', STR_PAD_LEFT);
        $author = Author::create([
            'code' => $code,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'bio' => $request->bio,
            'birth_date' => $request->birth_date,
            'nationality' => $request->nationality,
            'photo' => $request->photo,
            'is_active' => true,
        ]);

        return response()->json([ 'message' => 'Author berhasil ditambahkan', 'data' => $author], 201);
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
            Author::findOrFail($id)
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
        $author = Author::findOrFail($id);

        $author->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'bio' => $request->bio,
            'birth_date' => $request->birth_date,
            'nationality' => $request->nationality,
            'photo' => $request->photo,
            'is_active' => $request->is_active,
        ]);

        return response()->json([ 'message' => 'Author berhasil diupdate', 'data' => $author]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Author::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Author berhasil dihapus'
        ]);
    }
}
