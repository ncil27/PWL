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
}
