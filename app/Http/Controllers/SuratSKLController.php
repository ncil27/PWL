<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuratSKLController extends Controller
{
    public function create()
    {
        return view('surat.skl.create');
    }
}
