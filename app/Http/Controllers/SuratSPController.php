<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratPengantar;

class SuratSPController extends Controller
{
    public function create()
    {
        return view('surat.sp.create');
    }

    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            // 'id_pengajuan' => 'required|string|max:9',
            'penerima' => 'required|string|max:100',
            'kode_matkul' => 'required|string|max:10',
            'periode' => 'required|string|max:10',
            'tujuan' => 'required|string|max:100',
            'topik' => 'required|string|max:100',
            'data_mhs' => 'required|string|max:150',
        ]);

        // Generate ID Surat Pengantar (misalnya format: SP-YYYYMMDD-XXXX)
        // $id_surat_pengantar = 'SP-' . date('Ymd') . '-' . Str::random(4);

        // Simpan data ke tabel `surat_pengantar`
        SuratPengantar::create([
            // 'id_surat_pengantar' => $id_surat_pengantar,
            'id_pengajuan' => $request->id_pengajuan,
            'penerima' => $request->penerima,
            'kode_matkul' => $request->kode_matkul,
            'periode' => $request->periode,
            'tujuan' => $request->tujuan,
            'topik' => $request->topik,
            'data_mhs' => $request->data_mhs,
        ]);

        return redirect()->back()->with('success', 'Surat Pengantar berhasil diajukan!');
    }
}
