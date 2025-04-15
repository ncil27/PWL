<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Models\MO;
use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\SuratLHS;
use App\Models\SuratPengantar;
use App\Models\SuratSKL;
use App\Models\SuratSKMA;

class MOController extends Controller
{
    public function finalPengajuan(){
        $pengajuan = Pengajuan::with(['skma', 'mahasiswa', 'jenisSurat'])->get();
        $skma = SuratSKMA::all();
        $pengantar = SuratPengantar::all();
        $laporan = SuratLHS::all();
        $kelulusan = SuratSKL::all();

        return view('roles.mo.final-pengajuan', compact(
            'pengajuan', 'skma', 'pengantar', 'laporan', 'kelulusan'
        ));
    // public function store(Request $request){
    //     // $validatedData = $request->validate([

    //     // ])
    //     MO::([
    //         'file_surat' => ['required', 'application', 'mimes:pdf']
    //     ]);


    //     return redirect()->back()->with('success', 'Surat berhasil dikirim!');

    // 
    }

    public function showDetail($id_pengajuan)
    {
        $pengajuan = Pengajuan::with('jenisSurat')->findOrFail($id_pengajuan);
        $kode_surat = $pengajuan->kode_surat;
        $detail = null;

        switch ($kode_surat) {
            case 0:
                $detail = SuratSKMA::where('id_pengajuan', $id_pengajuan)->first();
                break;
            case 1:
                $detail = SuratPengantar::where('id_pengajuan', $id_pengajuan)->first();
                break;
            case 2:
                $detail = SuratLHS::where('id_pengajuan', $id_pengajuan)->first();
                break;
            case 3:
                $detail = SuratSKL::where('id_pengajuan', $id_pengajuan)->first();
                break;
            default:
                // handle unknown type
                break;
            }

        $skma = SuratSKMA::all();
        $pengantar = SuratPengantar::all();
        $laporan = SuratLHS::all();
        $kelulusan = SuratSKL::all();
    
        return view('roles.mo.final-pengajuan', compact('pengajuan', 'skma', 'pengantar', 'laporan', 'kelulusan'));
        }

        // return response()->json([
        //     'pengajuan' => $pengajuan,
        //     'detail' => $detail
        // ]);
}

