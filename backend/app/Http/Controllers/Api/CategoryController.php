<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            Category::latest()->paginate(10)
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
            'name' => 'required|max:255'
        ]);
        $lastCategory = Category::latest('id')->first();
        $number = $lastCategory
            ? intval(substr($lastCategory->code, 3)) + 1 : 1;
        $code = 'CAT' . str_pad($number, 5, '0', STR_PAD_LEFT);
        $category = Category::create([
            'code' => $code,
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => true
        ]);
        return response()->json([
            'message' => 'Kategori berhasil ditambahkan', 'data' => $category], 201);
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
            Category::findOrFail($id)
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
        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => $request->is_active
        ]);
        return response()->json(['message' => 'Kategori berhasil diupdate', 'data' => $category]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return response()->json([
            'message' => 'Kategori berhasil dihapus'
        ]);
    }
}
