<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RekapPosyanduControler extends Controller
{
    public function index()
    {
        return view('pages.backend.rekap-posyandu');
    }
}
