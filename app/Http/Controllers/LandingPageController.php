<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Beritas;

class LandingPageController extends Controller
{
    //
    public function index()
    {
        //$products = Product::latest()->paginate(5);
        //$kegiatan = Kegiatan::latest()->paginate(5);
        $berita = "Berita";
        $acara = "Apa Yang Terjadi";
        $pengalaman = "Pengalaman Mereka.";
        $header     = true;
        $ceritalain = true;
        $navhalaman = false;
        $toptitle    = "To Be The One, To Be The Winner";
        $beritas = Beritas::latest()->paginate(5);
        return view('landingpage.index', compact('berita', 'acara', 'pengalaman',
                    'header','ceritalain','navhalaman','toptitle','beritas'));
        //return view('landingpage.layout');
    }

    public function pengalaman(){
        $pengalaman = "Pengalaman Mereka.";
        $detailjudulhalaman = "TEMUKAN CERITA YANG LAIN.";

        // Pengaturan
        $header = false;
        $ceritalain = false;
        $navhalaman = true;

        return view('detail-pengalaman.index', compact('pengalaman', 'detailjudulhalaman', 'header','ceritalain','navhalaman'));
    }
}

