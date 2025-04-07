<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratSKL;


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
}
