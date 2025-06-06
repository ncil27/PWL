<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\User;
use App\Models\SuratSKMA;
use App\Models\JenisSurat;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class PengajuanController extends Controller
{

    public function index()
    {
        $pengajuans = Pengajuan::with('jenisSurat')->orderBy('created_at', 'desc')
        ->paginate(25);
        $users = User::all();
        
        return view('roles.kaprodi.manage-pengajuan', compact('pengajuans','users'));
    }

    public function indexForMO()
    {
        $pengajuans = Pengajuan::with(['user', 'jenisSurat'])
                        ->where('status_pengajuan', 1)
                        ->get();

        return view('roles.mo.final-pengajuan', compact('pengajuans'));
    }
    // public function store(Request $request)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'nama' => 'required|string|max:255',
    //         'nim' => 'required|string|max:20',
    //         'jenis_surat' => 'required|string',
    //         'alasan' => 'required|string',
    //     ]);

    //     // Simpan ke database
    //     PengajuanSurat::create([
    //         'nama' => $request->nama,
    //         'nim' => $request->nim,
    //         'jenis_surat' => $request->jenis_surat,
    //         'alasan' => $request->alasan,
    //     ]);

    //     return redirect()->back()->with('success', 'Pengajuan surat berhasil dikirim.');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'kode_surat' => 'required|exists:jenis_surat,kode_surat',
        ]);

        Pengajuan::create([
            // 'id_pengajuan' => uniqid('PGN_'),
            'id_mhs' => Auth::user()->id_user,
            'kode_surat' => $request->kode_surat,
            'status_pengajuan' => 0,
        ]);

        /*
        if ($user->id_role === 0) {
            return view('roles.admin.dashboard', compact('jenisSurat'));
        } elseif ($user->id_role === 1) {
            return view('roles.kaprodi.dashboard', compact('jenisSurat'));
        } elseif ($user->id_role === 2) {
            return view('roles.mo.dashboard', compact('jenisSurat'));
        } elseif ($user->id_role === 3) {
            return view('roles.mahasiswa.dashboard', compact('jenisSurat'));
        }
        */

        if($request->kode_surat === 0){
            
        }
    
        return redirect()->back()->with('success', 'Pengajuan surat berhasil dikirim!');
    }

    // public function formPengajuan($kode_surat)
    // {
    //     // Ambil data jenis surat dari database
    //     $jenisSurat = JenisSurat::where('kode_surat', $kode_surat)->firstOrFail();

    //     // Redirect ke view sesuai dengan jenis surat
    //     // return view('pengajuan.form', compact('jenisSurat'));
    // }

    public function redirectSurat(Request $request)
    {
        $request->validate([
            'kode_surat' => 'required|exists:jenis_surat,kode_surat',
        ]);

        $pengajuan = Pengajuan::create([
            'id_mhs' => Auth::user()->id_user,
            'kode_surat' => $request->kode_surat,
            'status_pengajuan' => 0,
        ]);
        $latestPengajuan = Pengajuan::where('id_mhs', Auth::user()->id_user)
            ->orderBy('created_at', 'desc')
            ->first();

        $kodeSurat = $request->kode_surat;

        switch ($kodeSurat) {
            case '0':
                return redirect()->route('surat.skma.create', ['id_pengajuan' => $latestPengajuan->id_pengajuan]);
            case '1':
                return redirect()->route('surat.sp.create', ['id_pengajuan' => $latestPengajuan->id_pengajuan]);
            case '2':
                return redirect()->route('surat.slhs.create', ['id_pengajuan' => $latestPengajuan->id_pengajuan]);
            case '3':
                return redirect()->route('surat.skl.create', ['id_pengajuan' => $latestPengajuan->id_pengajuan]);
            default:
                return redirect()->back()->with('error', 'Jenis surat tidak dikenali');
        }
        
    }
    
    public function destroyTemporary($id)
    {
        // dd($id);
        $pengajuan = Pengajuan::where('id_pengajuan', $id)->first();
        if ($pengajuan) {
            $pengajuan->delete();
            DB::table('pengajuan')->where('id_pengajuan', $id)->delete();
        }

        return redirect('/dashboard')->with('success', 'Data pengajuan dibatalkan dan telah dihapus.');
    }

    // public function updateStatus(Request $request, $id)
    // {
    //     $request->validate([
    //         'status_pengajuan' => 'required|in:approved,ditolak',
    //     ]);

    //     $pengajuan = Pengajuan::findOrFail($id);
    //     $pengajuan->status_pengajuan = $request->status_pengajuan;
    //     $pengajuan->save();

    //     return redirect()->route('pengajuan.index') // ganti sesuai route dashboard kaprodi
    //         ->with('success', 'Status pengajuan berhasil diperbarui.');
    // }

    public function updateStatus(Request $request, $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status_pengajuan = $request->status;
        $pengajuan->save();

        return redirect()->route('kaprodi.manage-pengajuan')->with('success', 'Status pengajuan berhasil diperbarui.');
    }



    public function uploadSurat(Request $request, $id)
    {
        $request->validate([
            'file_surat' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $pengajuan = Pengajuan::findOrFail($id);

        if ($request->hasFile('file_surat')) {
            $file = $request->file('file_surat');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('surat', $filename);

            // Simpan nama file ke kolom di database (pastikan kolom file_surat sudah ada)
            $pengajuan->file_surat = $path;
            $pengajuan->status_pengajuan = 2; // Disetujui final
            $pengajuan->save();
        }

        return redirect()->back()->with('success', 'Surat berhasil diupload.');
    }

    public function lihatFile($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        if ($pengajuan->status != 2 || !$pengajuan->file_surat) {
            abort(404, 'File belum tersedia atau pengajuan belum disetujui.');
        }

        $path = storage_path('app/public/surat/' . $pengajuan->file_surat);

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->file($path);
    }


}



