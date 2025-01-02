<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class layananController extends Controller
{
    public function index()
    {
        return view('layanan'); // Menampilkan halaman layanan
    }


}
