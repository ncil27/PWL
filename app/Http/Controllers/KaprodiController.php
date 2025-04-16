<?php

namespace App\Http\Controllers;
use App\Models\Pengajuan;

use Illuminate\Http\Request;

class KaprodiController extends Controller
{
    public function index()
    {
        return view('kaprodi.dashboard');
    }

    // public function managePengajuan(){
    //     $pengajuan = Pengajuan::with(['skma', 'mahasiswa', 'jenisSurat'])->get();
    // return view('roles.kaprodi.manage-pengajuan', compact('pengajuan'));
    // }
    public function managePengajuan()
    {
        $pengajuans = Pengajuan::with(['jenisSurat', 'skma', 'mahasiswa','suratPengantar','suratSKL'])
            ->orderBy('created_at', 'desc')
            ->paginate(25);

        return view('roles.kaprodi.manage-pengajuan', compact('pengajuans'));
    }

}
