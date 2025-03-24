<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengantarController extends Controller
{
    
    public function store(Request $request){
        dd($request->all());
    }
}
