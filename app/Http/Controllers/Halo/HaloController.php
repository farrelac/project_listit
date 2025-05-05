<?php

namespace App\Http\Controllers\Halo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HaloController extends Controller
{
    public function coba(){
        $nama = 'Farrel';
        $data = ['Nama' => $nama]; //perhatikan key yg dimasukkan untuk manggil variabelnya
        return view('coba.halo', $data);
    }
}
