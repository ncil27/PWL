<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratPengantar;
use App\Models\Pengajuan;
use App\Models\Periode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SuratSPController extends Controller
{
    public function create($id_pengajuan)
    {
        $periode = Periode::all();
        return view('surat.sp.create',compact( 'id_pengajuan','periode'));
    }

    public function store(Request $request)
    {
        Log::info('SPController dipanggil');
        // dd($request->all());
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
            'id_pengajuan' => $request->id_pengajuan,
            'penerima' => $request->penerima,
            'kode_matkul' => $request->kode_matkul,
            'id_periode' => $request->id_periode,
            'tujuan' => $request->tujuan,
            'topik' => $request->topik,
            'data_mhs' => $request->data_mhs,
        ]);


        /// ini yang gue coba tambahin -cecil
        $surat = new SuratPengantar();
        $surat->id_pengajuan = $request->id_pengajuan;
        $surat->penerima = $request->penerima;
        $surat->kode_matkul = $request->kode_matkul;
        $surat->id_periode = $request->id_periode;
        $surat->data_mhs = $request->data_mhs;
        $surat->tujuan = $request->tujuan;
        $surat->topik = $request->topik;
        $surat->save();


        return redirect()->route('dashboard')->with('success', 'Surat Pengantar berhasil diajukan!');
    }

    public function edit($id_pengajuan)
    {
        $pengajuan = Pengajuan::where('id_pengajuan', $id_pengajuan)->firstOrFail();
        if ($pengajuan->status_pengajuan != 0) {
            return redirect()->route('mahasiswa.riwayat')->with('toast', [
                'type' => 'error',
                'message' => 'Pengajuan sudah diproses dan tidak dapat diedit.',
            ]);
        }
        $periode = Periode::all();
        $sp = SuratPengantar::where('id_pengajuan', $id_pengajuan)->firstOrFail();
        return view('surat.sp.edit', compact('sp', 'id_pengajuan','periode'));
    }

    public function update(Request $request, $id_pengajuan)
    {
        $request->validate([
            'id_pengajuan' => 'required|exists:pengajuan,id_pengajuan',
            'penerima' => 'required|string|max:100',
            'kode_matkul' => 'required|string|max:10',
            'id_periode' => 'required|string|max:15',
            'tujuan' => 'required|string|max:200',
            'topik' => 'required|string|max:100',
            'data_mhs' => 'required|string|max:150',        ]);

        $spt = SuratPengantar::where('id_pengajuan', $id_pengajuan)->firstOrFail();
        $spt->update([
            'id_pengajuan' => $request->id_pengajuan,
            'penerima' => $request->penerima,
            'kode_matkul' => $request->kode_matkul,
            'id_periode' => $request->id_periode,
            'tujuan' => $request->tujuan,
            'topik' => $request->topik,
            'data_mhs' => $request->data_mhs,        
        ]);

        return redirect()->route('mahasiswa.riwayat')->with('success', 'Surat sp berhasil diperbarui!');
    }

}

