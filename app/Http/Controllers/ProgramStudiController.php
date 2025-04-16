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
        return view('roles.admin.manage-data', [
            'users' => User::with('role')->get(),
            'programStudi' => ProgramStudi::all(),
            'jenisSurat' => JenisSurat::all(),
        ]);
    }


    public function create() {
        return view('admin.manage-data.create');
    }
    
    public function store(Request $request) {
        ProgramStudi::create([
            'program_studi' => $request->program_studi,
        ]);
        return redirect()->route('admin.manage-data')->with('success', 'Program studi ditambahkan!');
    }
    
    public function edit($id) {
        $program = ProgramStudi::findOrFail($id);
        return view('admin.manage-data.edit', compact('program'));
    }
    
    public function update(Request $request, $id) {
        $program = ProgramStudi::findOrFail($id);
        $program->update([
            'program_studi' => $request->program_studi,
        ]);
        return redirect()->route('program-studi.index')->with('success', 'Program studi diperbarui!');
    }
    
    public function destroy($id) {
        ProgramStudi::destroy($id);
        return redirect()->route('program-studi.index')->with('success', 'Program studi dihapus!');
    }
}
