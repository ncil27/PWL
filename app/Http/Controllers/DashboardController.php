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

            $riwayat = SuratSKMA::where('id_user', $id_user)
                        ->orderBy('created_at', 'desc')
                        ->get();
                
            return view('roles.mahasiswa.dashboard', compact('jenisSurat','riwayat'));
            // return view('roles.mahasiswa.dashboard', compact('jenisSurat'));
        }

        // Default jika tidak memiliki role
        abort(403, 'Unauthorized');
    }
}
