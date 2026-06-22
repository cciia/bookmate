<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
    }

    public function show($id)
    {
        return response()->json(User::findOrFail($id));
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'role' => $request->role ?? 'pengunjung',
            'status' => $request->status ?? 'active',
        ]);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            'status' => $request->status,
        ]);

        return response()->json($user);
    }

    public function destroy($id)
    {
        User::destroy($id);

        return response()->json([
            'message' => 'User deleted successfully'
        ]);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Email tidak ditemukan'
            ], 404);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Password salah'
            ], 401);
        }

        return response()->json([
            'message' => 'Login berhasil',
            'user' => $user
        ]);
    }
}
