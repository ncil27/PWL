<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSurat;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;


class PengajuanController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20',
            'jenis_surat' => 'required|string',
            'alasan' => 'required|string',
        ]);

        // Simpan ke database
        PengajuanSurat::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'jenis_surat' => $request->jenis_surat,
            'alasan' => $request->alasan,
        ]);

        return redirect()->back()->with('success', 'Pengajuan surat berhasil dikirim.');
    }

}
