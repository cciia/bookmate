<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            User::latest()->paginate(10)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|max:150',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role'     => 'required',
        ]);
        $lastUser = User::latest('id')->first();
        $number = ($lastUser && $lastUser->code)
            ? intval(substr($lastUser->code, 3)) + 1 : 1;
        $code = 'USR' . str_pad($number, 5, '0', STR_PAD_LEFT);
        $user = User::create([
            'code'       => $code,
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'phone'      => $request->phone,
            'gender'     => $request->gender,
            'address'    => $request->address,
            'photo'      => $request->photo,
            'role'       => $request->role,
            'is_active'  => true,
        ]);
        return response()->json(['message' => 'User berhasil ditambahkan', 'data' => $user], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return response()->json(
            User::findOrFail($id)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|max:150',
            'email' => 'required|email|unique:users,email,' . $id,
            'role'  => 'required',
        ]);

        $user = User::findOrFail($id);

        $data = [
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'gender'    => $request->gender,
            'address'   => $request->address,
            'photo'     => $request->photo,
            'role'      => $request->role,
            'is_active' => $request->is_active,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return response()->json([
            'message' => 'User berhasil diperbarui',
            'data'    => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return response()->json([
            'message' => 'User berhasil dihapus'
        ]);
    }
}