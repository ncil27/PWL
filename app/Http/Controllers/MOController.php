<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Models\MO;
use Illuminate\Http\Request;
use App\Models\Pengajuan;

class MOController extends Controller
{
    public function finalPengajuan(){
        $pengajuan = Pengajuan::with(['skma', 'mahasiswa', 'jenisSurat'])->get();
    return view('roles.mo.final-pengajuan', compact('pengajuan'));
    }
    // public function store(Request $request){
    //     // $validatedData = $request->validate([

    //     // ])
    //     MO::([
    //         'file_surat' => ['required', 'application', 'mimes:pdf']
    //     ]);


    //     return redirect()->back()->with('success', 'Surat berhasil dikirim!');

    // }
}
