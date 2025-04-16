<?php

// namespace App\Http\Controllers;
// use App\Models\JenisSurat;
// use Illuminate\Http\Request;
// use App\Http\Requests;
// use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\DB;

// class DashboardController extends Controller
// {
//     public function index()
//     {
//         return view('dashboard');
//     }
//     public function dashboardMahasiswa()
//     {
//         $jenisSurat = JenisSurat::all(); // Ambil semua jenis surat
//         return view('dashboard.mahasiswa', compact('jenisSurat'));
//     }
// }

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JenisSurat;
use App\Models\SuratSKMA;
use App\Models\Pengajuan;


class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Ambil pengguna yang sedang login
        $jenisSurat = JenisSurat::all(); // Ambil semua jenis surat

        // Redirect berdasarkan role dengan membawa data jenis surat
        if ($user->id_role === 0) {
            return view('roles.admin.dashboard', compact('jenisSurat'));
        } elseif ($user->id_role === 1) {
            return view('roles.kaprodi.dashboard', compact('jenisSurat'));
        } elseif ($user->id_role === 2) {
            return view('roles.mo.dashboard', compact('jenisSurat'));
        } elseif ($user->id_role === 3) {
            $id_user = auth()->user()->id_user;
            
            $riwayat = \DB::table('surat_mhs_aktif')
            ->join('pengajuan', 'surat_mhs_aktif.id_pengajuan', '=', 'pengajuan.id_pengajuan')
            ->where('pengajuan.id_mhs', $id_user)
            ->orderBy('surat_mhs_aktif.created_at', 'desc')
            ->select('surat_mhs_aktif.*', 'pengajuan.status_pengajuan') // <-- ini penting
            ->get();

            
                
            return view('roles.mahasiswa.dashboard', compact('jenisSurat','riwayat'));
            // return view('roles.mahasiswa.dashboard', compact('jenisSurat'));
        }

        // Default jika tidak memiliki role
        abort(403, 'Unauthorized');
    }


    public function riwayat()
    {
        $user = Auth::user();

        // Ambil semua pengajuan milik mahasiswa ini
        $pengajuans = Pengajuan::with(['jenisSurat', 'skma', 'mahasiswa'])
            ->where('id_mhs', $user->id_user)
            ->orderBy('id_pengajuan','asc')
            ->paginate(25);

        return view('roles.mahasiswa.riwayat', compact('pengajuans'));
    }

}
