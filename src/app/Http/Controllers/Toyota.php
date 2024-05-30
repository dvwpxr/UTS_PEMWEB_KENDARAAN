<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kendaraan;

class Toyota extends Controller
{
    public function home()
    {
        $kendaraans = Kendaraan::get();
        return view('kendaraan.index', compact('kendaraans'));
    }
}
