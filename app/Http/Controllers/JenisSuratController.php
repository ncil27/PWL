<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use App\Models\ProgramStudi;
use App\Models\User;
use Illuminate\Http\Request;

class JenisSuratController extends Controller
{
    public function index()
    {
        $programStudi = ProgramStudi::all();
        $jenisSurat = JenisSurat::all();
        $users = User::with('role')->get();
        
        return view('roles.admin.manage-data', compact('programStudi', 'users', 'jenisSurat'));
    }

    public function create()
    {
        return view('admin.jenis-surat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat' => 'required|string|max:100|unique:jenis_surat,jenis_surat',
        ]);

        JenisSurat::create([
            'jenis_surat' => $request->jenis_surat,
        ]);

        return redirect()->route('admin.jenis-surat.index')->with('success', 'Jenis surat berhasil ditambahkan.');
    }

    public function edit($kode_surat)
    {
        $jenisSurat = JenisSurat::findOrFail($kode_surat);
        return view('admin.jenis-surat.edit', compact('jenisSurat'));
    }

    public function update(Request $request, $kode_surat)
    {
        $request->validate([
            'jenis_surat' => 'required|string|max:100|unique:jenis_surat,jenis_surat,' . $kode_surat . ',kode_surat',
        ]);

        $jenisSurat = JenisSurat::findOrFail($kode_surat);
        $jenisSurat->update([
            'jenis_surat' => $request->jenis_surat,
        ]);

        return redirect()->route('admin.jenis-surat.index')->with('success', 'Jenis surat berhasil diupdate.');
    }


    public function destroy($kode_surat)
    {
        $jenisSurat = JenisSurat::findOrFail($kode_surat);
        $jenisSurat->delete();

        return redirect()->route('admin.jenis-surat.index')->with('success', 'Jenis surat berhasil dihapus.');
    }
}
