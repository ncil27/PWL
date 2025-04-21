<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\ProgramStudi;

class AdminController extends Controller
{
    public function index()
    {
        $programStudi = ProgramStudi::all();
        return view('roles.admin.dashboard');
    }

    public function manageUsers()
    {
        return view('roles.admin.manage-user');
    }
    public function manageData()
    {
        return view('roles.admin.manage-data');
    }

    public function createUser(){
        
        $roles = Role::all();
        $programStudi = ProgramStudi::all();
        return view('roles.admin.create-user', compact('roles', 'programStudi'));
    }


}
