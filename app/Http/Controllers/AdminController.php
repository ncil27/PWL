<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Role;

class AdminController extends Controller
{
    public function index()
    {
        return view('roles.admin.dashboard');
    }

    public function manageUsers()
    {
        return view('roles.admin.manage-user');
    }

    public function createUser(){
        
        $roles = Role::all();
        return view('roles.admin.create-user', compact('roles'));
    }


}
