<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramStudi;

class HomeController extends Controller
{
    public function beranda()
    {
        return view('beranda');
    }

    public function programStudi()
    {
        $programStudi = ProgramStudi::all();
        return view('program-studi', compact('programStudi'));
    }

    public function alur()
    {
        return view('alur');
    }

    public function jadwal()
    {
        return view('jadwal');
    }

    public function faq()
    {
        return view('faq');
    }

    public function kontak()
    {
        return view('kontak');
    }
}