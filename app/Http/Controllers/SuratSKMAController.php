<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratSKMA;
use App\Models\Pengajuan;
use App\Models\Periode;
use Illuminate\Support\Facades\DB;
class SuratSKMAController extends Controller
{
    
    public function create($id_pengajuan)
    {
        $periode = Periode::all();
        return view('surat.skma.create', compact('id_pengajuan', 'periode'));
    }
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'id_pengajuan' => 'required|exists:pengajuan,id_pengajuan',
            'semester' => 'required|integer|min:1|max:14',
            'keperluan' => 'required|string|max:255',
            'id_periode' => 'required|string|max: 15',
        ]);
    
        SuratSKMA::create([
            'id_pengajuan' => $request->id_pengajuan,
            'semester' => $request->semester,
            'keperluan' => $request->keperluan,
            'id_periode' => $request->id_periode,
        ]);
    
        return redirect()->route('dashboard')->with('success', 'Surat SKMA berhasil diajukan!');
    }
    public function riwayatPengajuan()
    {
        $riwayat = auth()->user()->suratSKMA()->latest()->get();
        return view('roles.mahasiswa.riwayat', compact('riwayat'));
    }
}

