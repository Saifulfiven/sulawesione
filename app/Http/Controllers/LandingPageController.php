<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Beritas;
use App\Models\Provinces;

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

        
        $provinsi = Provinces::where('status', 1)->get();
        
        $beritas = Beritas::latest()->paginate(5);
        return view('landingpage.index', compact('berita', 'acara', 'pengalaman',
                    'header','ceritalain','navhalaman','toptitle','beritas','provinsi'));
        //return view('landingpage.layout');
    }

    public function pengalaman(){
        
        $pengalaman = "Pengalaman Mereka.";
        $detailjudulhalaman = "TEMUKAN CERITA YANG LAIN.";

        // Pengaturan
        $header = false;
        $ceritalain = false;
        $navhalaman = true;

        $provinsi = Provinces::where('status', 1)->get();
        return view('detail-pengalaman.index', compact('pengalaman', 'detailjudulhalaman', 'header','ceritalain','navhalaman','provinsi'));
    }


    public function bacaberita($slug)
    {
        $berita = Beritas::where('slug', $slug)->firstOrFail();
        $toptitle = $slug;

        $judulheader = $berita->judul;
        $sharegambar = 'berita/'.$berita->gambar;
        $header     = false;
        $ceritalain = false;
        $navhalaman = false;

        $beritas = Beritas::latest()->paginate(5);

        // // Menyimpan IP pengunjung
        // $ip_address = $_SERVER['REMOTE_ADDR'];
        // $pengunjung = Pengunjungs::whereRaw("posisi = ? and date(created_at) = curdate()", [$ip_address])->first();
        // if (!$pengunjung) {
        //     $pengunjung = new Pengunjungs;
        //     $pengunjung->ip_pengunjung = $ip_address;
        //     $pengunjung->posisi = $slug;
        //     $pengunjung->save();
        // }

        return view('landingpage.indexberita', compact('berita','header',
                   'ceritalain','navhalaman','beritas','judulheader','sharegambar','toptitle'));
    }

}

