<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratSKL;
use App\Models\Pengajuan;


class SuratSKLController extends Controller
{
    public function create($id_pengajuan)
    {
        return view('surat.skl.create',compact('id_pengajuan'));
    }
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'id_pengajuan' => 'required|exists:pengajuan,id_pengajuan',
            'tgl_lulus' => 'required|date',
        ]);

        SuratSKL::create([
            'id_pengajuan' => $request->id_pengajuan,
            'tgl_lulus' => $request->tgl_lulus,
        ]);

        return redirect()->route('dashboard')->with('success', 'Surat SKL berhasil diajukan!');
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
        else{
            $skl = SuratSKL::where('id_pengajuan', $id_pengajuan)->firstOrFail();
            return view('surat.skl.edit', compact('skl', 'id_pengajuan'));
        }
    }

    public function update(Request $request, $id_pengajuan)
    {
        $request->validate([
            'id_pengajuan' => 'required|exists:pengajuan,id_pengajuan',
            'tgl_lulus' => 'required|date',
        ]);

        $skl = SuratSKL::where('id_pengajuan', $id_pengajuan)->firstOrFail();
        $skl->update([
            'id_pengajuan' => $request->id_pengajuan,
            'tgl_lulus' => $request->tgl_lulus,
        ]);

        return redirect()->route('mahasiswa.riwayat')->with('success', 'Surat Keterangan Lulus berhasil diperbarui!');
    }

}
