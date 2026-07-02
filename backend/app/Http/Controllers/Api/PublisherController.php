<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Publisher;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            Publisher::latest()->paginate(10)
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
        $lastPublisher = Publisher::latest('id')->first();
        $number = $lastPublisher
            ? intval(substr($lastPublisher->code, 3)) + 1 : 1;
        $code = 'PUB' . str_pad($number, 5, '0', STR_PAD_LEFT);
        $publisher = Publisher::create([
            'code' => $code,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'pic_name' => $request->pic_name,
            'pic_phone' => $request->pic_phone,
            'pic_email' => $request->pic_email,
            'address' => $request->address,
            'city' => $request->city,
            'province' => $request->province,
            'postal_code' => $request->postal_code,
            'phone' => $request->phone,
            'email' => $request->email,
            'website' => $request->website,
            'logo' => $request->logo,
            'notes' => $request->notes,
            'is_active' => true
        ]);

        return response()->json(['message' => 'Penerbit berhasil ditambahkan', 'data' => $publisher], 201);
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
            Publisher::findOrFail($id)
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
        $publisher = Publisher::findOrFail($id);
        $publisher->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'pic_name' => $request->pic_name,
            'pic_phone' => $request->pic_phone,
            'pic_email' => $request->pic_email,
            'address' => $request->address,
            'city' => $request->city,
            'province' => $request->province,
            'postal_code' => $request->postal_code,
            'phone' => $request->phone,
            'email' => $request->email,
            'website' => $request->website,
            'logo' => $request->logo,
            'notes' => $request->notes,
            'is_active' => $request->is_active
        ]);

        return response()->json(['message' => 'Penerbit berhasil diupdate', 'data' => $publisher]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Publisher::findOrFail($id)->delete();
        return response()->json([
            'message' => 'Penerbit berhasil dihapus'
        ]);
    }
}
