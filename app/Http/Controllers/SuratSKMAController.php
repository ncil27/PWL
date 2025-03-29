<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class SuratSKMAController extends Controller
{
    public function create()
    {
        return view('surat.skma.create');
    }
}

