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
        $usersAktif = User::aktif()->get();

        return view('roles.admin.manage-user', compact('users', 'usersAktif'));
    }

    /**
     * Tambahkan user baru.
     */
    public function store(Request $request)
        {
            Log::info('Data yang masuk:', $request->all());

            // Cek dulu: kalau role = Kaprodi (id_role == 1)
            
            try {
                if ($request->id_role == 1) {
                    $kaprodiAktif = User::where('id_role', 1)
                        ->where('id_prodi', $request->id_prodi)
                        ->where('status', 1)
                        ->first();
    
                    if ($kaprodiAktif) {
                        return redirect()->back()
                            ->with('error', 'Sudah ada Kaprodi aktif untuk prodi ini.')
                            ->withInput();
                    }
                }
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

                // Log::info('User berhasil dibuat:', $user->toArray());

                // return redirect()->route('admin.manage-user')->with('success', 'User berhasil ditambahkan');
                Log::info('Sampai di akhir store');
                return redirect()->route('admin.manage-user')->with('success', 'User berhasil ditambahkan');

            } catch (\Exception $e){
                Log::error('Gagal buat user: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Gagal menyimpan user');
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

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->status = $user->status === 1 ? 0 : 1;
        $user->save();

        return redirect()->back()->with('success', 'Status berhasil diubah.');
    }

}
