<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Tampilkan daftar semua pengguna.
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Tambahkan user baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:20|unique:users,username',
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:mahasiswa,admin,mo,kaprodi',
            'status' => 'required|in:aktif,non-aktif',
            'id_prodi' => 'required|string|size:2',
        ]);

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => $request->status,
            'id_prodi' => $request->id_prodi,
        ]);


        return response()->json([
            'message' => 'User berhasil dibuat',
            'user' => $user
        ], 201);
    }

    /**
     * Tampilkan detail user berdasarkan ID.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Update data user.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users,email,' . $user->id_user . ',id_user',
            'role' => 'required|in:mahasiswa,admin,mo,kaprodi',
            'status' => 'required|in:aktif,non-aktif',
            'id_prodi' => 'required|string|size:2',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'status' => $request->status,
            'id_prodi' => $request->id_prodi,
        ]);
        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->update($request->except('password'));
        return response()->json(['message' => 'User berhasil diperbarui']);
    }

    /**
     * Hapus user berdasarkan ID.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User berhasil dihapus']);
    }
}
