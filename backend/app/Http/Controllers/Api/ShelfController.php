<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Shelf;

class ShelfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            Shelf::latest()->paginate(10)
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
            'name' => 'required|max:100'
        ]);

        $lastShelf = Shelf::latest('id')->first();

        $number = ($lastShelf && $lastShelf->code)
            ? intval(substr($lastShelf->code, 2)) + 1
            : 1;

        $code = 'SH' . str_pad($number, 5, '0', STR_PAD_LEFT);

        $shelf = Shelf::create([
            'code' => $code,
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'is_active' => true
        ]);

        return response()->json(['message' => 'Shelf berhasil ditambahkan', 'data' => $shelf], 201);
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
            Shelf::findOrFail($id)
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
        $shelf = Shelf::findOrFail($id);
        $shelf->update([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'is_active' => $request->is_active
        ]);

        return response()->json(['message' => 'Shelf berhasil diupdate', 'data' => $shelf]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Shelf::findOrFail($id)->delete();
        return response()->json([
            'message' => 'Shelf berhasil dihapus'
        ]);
    }
}
