<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuratSLHSController extends Controller
{
    public function create()
    {
        return view('surat.slhs.create');
    }
}
