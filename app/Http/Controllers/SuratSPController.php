<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratPengantar;
use App\Models\Pengajuan;
use App\Models\Periode;
use Illuminate\Support\Facades\DB;

class SuratSPController extends Controller
{
    public function create($id_pengajuan)
    {
        $periode = Periode::all();
        return view('surat.sp.create',compact( 'id_pengajuan','periode'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'id_pengajuan' => 'required|exists:pengajuan,id_pengajuan',
            'penerima' => 'required|string|max:100',
            'kode_matkul' => 'required|string|max:10',
            'id_periode' => 'required|string|max:15',
            'tujuan' => 'required|string|max:200',
            'topik' => 'required|string|max:100',
            'data_mhs' => 'required|string|max:150',
        ]);

        SuratPengantar::create([
            // 'id_surat_pengantar' => $id_surat_pengantar,
            'id_pengajuan' => $request->id_pengajuan,
            'penerima' => $request->penerima,
            'kode_matkul' => $request->kode_matkul,
            'id_periode' => $request->id_periode,
            'tujuan' => $request->tujuan,
            'topik' => $request->topik,
            'data_mhs' => $request->data_mhs,
        ]);

        return redirect()->route('dashboard')->with('success', 'Surat Pengantar berhasil diajukan!');
    }
}
