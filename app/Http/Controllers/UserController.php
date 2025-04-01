<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\ProgramStudi;
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
        $roles = Role::all();
        return response()->json($users);
    }

    /**
     * Tambahkan user baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|string|max:9|unique:users,id_user',
            'username' => 'required|string|max:20|unique:users,id_user',
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|string|max:10',
            'status' => 'required|string|max:11',
        ]);

        $user = User::create([
            'id_user' => $request->id_user,
            'username' => $request->id_user,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => $request->status,
            'program_studi' => $request->program_studi,
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
            'name' => 'sometimes|string|max:100',
            'email' => 'sometimes|string|email|max:100|unique:users,email,' . $id . ',id_user',
            'password' => 'sometimes|string|min:6',
            'role' => 'sometimes|string|max:10',
            'status' => 'sometimes|string|max:11',
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

    public function users()
    {
    $allUsers = User::with('role')->get();
    return view('users', ['users' => $allUsers]);
    }
    public function create()
    {
        $roles = Role::all(); // Ambil semua role dari tabel roles
        $programStudi = ProgramStudi::all();
        return view('admin.create-user', compact('roles','programStudi'));
    }
}
