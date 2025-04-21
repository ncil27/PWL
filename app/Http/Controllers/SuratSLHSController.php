<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\SuratLHS;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\DB;

class SuratSLHSController extends Controller
{
    public function create($id_pengajuan)
    {
        return view('surat.slhs.create',compact('id_pengajuan'));
    }
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'id_pengajuan' => 'required|exists:pengajuan,id_pengajuan',
            'keperluan' => 'required|string|max:100',
        ]);

        SuratLHS::create([
            'id_pengajuan' => $request->id_pengajuan,
            'keperluan' => $request->keperluan,
        ]);

        return redirect()->route('dashboard')->with('success', 'Surat LHS berhasil diajukan!');
    }

    public function edit($id_pengajuan)
    {
        $pengajuan = Pengajuan::where('id_pengajuan', $id_pengajuan)->firstOrFail();
        if ($pengajuan->stastatus_pengajuantus != 0) {
            return redirect()->route('mahasiswa.riwayat')->with('toast', [
                'type' => 'error',
                'message' => 'Pengajuan sudah diproses dan tidak dapat diedit.',
            ]);
        }
        $slhs = SuratLHS::where('id_pengajuan', $id_pengajuan)->firstOrFail();
        return view('surat.slhs.edit', compact('slhs', 'id_pengajuan',));
    }

    public function update(Request $request, $id_pengajuan)
    {
        
        $slhs = SuratLHS::where('id_pengajuan', $id_pengajuan)->firstOrFail();
        $request->validate([
            'id_pengajuan' => 'required|exists:pengajuan,id_pengajuan',
            'keperluan' => 'required|string|max:100',
        ]);

        $slhs->update([
            'id_pengajuan' => $request->id_pengajuan,
            'keperluan' => $request->keperluan,        ]);

        return redirect()->route('mahasiswa.riwayat')->with('success', 'Surat Keterangan Lulus berhasil diperbarui!');
    }

}
