<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\ProgramStudi;
use Illuminate\Support\Facades\Log;
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
        return view('roles.admin.manage-user', compact('users'));
    }

    /**
     * Tambahkan user baru.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'id_user' => 'required|string|max:9|unique:users,id_user',
        //     'username' => 'required|string|max:20|unique:users,id_user',
        //     'name' => 'required|string|max:100',
        //     'email' => 'required|string|email|max:100|unique:users,email',
        //     'password' => 'required|string|min:6',
        //     'role' => 'required|string|max:10',
        //     'status' => 'required|string|max:11',
        // ]);
        Log::info('Data yang masuk:', $request->all());

        // dd($request->all());
        try {
            $user = User::create([
                'id_user' => $request->id_user,
                'username' => $request->id_user,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'id_role' => $request->id_role,
                'status' => $request->status,
                'id_prodi' => $request->id_prodi,
            ]);
            

            Log::info('User berhasil dibuat:', $user->toArray());

            return redirect()->route('manage-user')->with('success', 'User berhasil ditambahkan');


            // return response()->json([
            //     'message' => 'User berhasil dibuat',
            //     'user' => $user
            // ], 201);
    } catch (\Exception $e){
        Log::error('Gagal buat user: ' . $e->getMessage());
        return response()->json(['error' => 'Gagal menyimpan user'], 500);
    }
}
    /**
     * Tampilkan detail user berdasarkan ID.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }


    // Tampilkan form edit
    public function edit($id)
    {
        $roles = Role::all();
        $user = User::findOrFail($id);
        $programStudi = ProgramStudi::all();
        return view('roles.admin.edit-user', compact('user','roles', 'programStudi'));
    }

    /**
     * Update data user.
     */
    public function update(Request $request, $id)
    {
        $roles = Role::all();
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|string|max:100',
            'email' => 'sometimes|string|email|max:100|unique:users,email,' . $id . ',id_user',
            'password' => 'sometimes|string|min:6',
            'id_role' => 'sometimes|string|max:10',
            'status' => 'sometimes|string|max:11',
            'id_prodi' => 'sometimes|string|max:2',
        ]);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);   
        }

        $user->update($request->except('password'));
        return redirect()->route('admin.manage-user')->with('success', 'User berhasil diupdate');
    }

    /**
     * Hapus user berdasarkan ID.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('manage-user')->with('success', 'User berhasil dihapus');
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
