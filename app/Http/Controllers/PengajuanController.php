<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class PengajuanController extends Controller
{
    // public function store(Request $request)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'nama' => 'required|string|max:255',
    //         'nim' => 'required|string|max:20',
    //         'jenis_surat' => 'required|string',
    //         'alasan' => 'required|string',
    //     ]);

    //     // Simpan ke database
    //     PengajuanSurat::create([
    //         'nama' => $request->nama,
    //         'nim' => $request->nim,
    //         'jenis_surat' => $request->jenis_surat,
    //         'alasan' => $request->alasan,
    //     ]);

    //     return redirect()->back()->with('success', 'Pengajuan surat berhasil dikirim.');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'kode_surat' => 'required|exists:jenis_surat,kode_surat',
        ]);

        Pengajuan::create([
            // 'id_pengajuan' => uniqid('PGN_'), // ID unik
            'id_mhs' => Auth::user()->id_user, // Ambil dari user yang login
            'kode_surat' => $request->kode_surat,
            'status_pengajuan' => 0, // Default status pending
        ]);

        /*
        if ($user->id_role === 0) {
            return view('roles.admin.dashboard', compact('jenisSurat'));
        } elseif ($user->id_role === 1) {
            return view('roles.kaprodi.dashboard', compact('jenisSurat'));
        } elseif ($user->id_role === 2) {
            return view('roles.mo.dashboard', compact('jenisSurat'));
        } elseif ($user->id_role === 3) {
            return view('roles.mahasiswa.dashboard', compact('jenisSurat'));
        }
        */

        if($request->kode_surat === 0){
            
        }
    
        return redirect()->back()->with('success', 'Pengajuan surat berhasil dikirim!');
    }
}



