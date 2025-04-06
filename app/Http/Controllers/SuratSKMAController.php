<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratSKMA;
use App\Models\Periode;

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
    
        return redirect()->route('dashboard')->with('success', 'Surat berhasil diajukan!');
    }


    
}

