<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\ProgramStudi;
use App\Models\JenisSurat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProgramStudiController extends Controller
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
        return view('admin.program-studi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'program_studi' => 'required|string|max:100'
        ]);

        ProgramStudi::create($request->all());
        return redirect()->route('program-studi.index')->with('success', 'Program Studi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $prodi = ProgramStudi::findOrFail($id);
        return view('admin.program-studi.edit', compact('prodi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'program_studi' => 'required|string|max:100'
        ]);

        $prodi = ProgramStudi::findOrFail($id);
        $prodi->update($request->all());
        return redirect()->route('program-studi.index')->with('success', 'Program Studi berhasil diupdate!');
    }

    public function destroy($id)
    {
        $prodi = ProgramStudi::findOrFail($id);
        $prodi->delete();
        return redirect()->route('program-studi.index')->with('success', 'Program Studi berhasil dihapus!');
    }
}