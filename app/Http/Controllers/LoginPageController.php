<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginPageController extends Controller
{
    //
    public function index()
    {
        //$products = Product::latest()->paginate(5);
        //$berita = Berita::latest()->paginate(5);
        //$kegiatan = Kegiatan::latest()->paginate(5);
        $judulconten = "Halaman Login";
        $header = false;
        
        return view('login.signin', compact('judulconten','header'));
    }


    public function login(Request $request)
    {
        $nomorktp = $request->nomorktp;
        $pemilih = Pemilih::where('nomorktp', $nomorktp)->first();
        if ($pemilih) {
            Auth::login($pemilih);
            return redirect('/');
        } else {
            return redirect('/login')->with('error', 'Nomor KTP tidak ditemukan');
        }
    }

}
