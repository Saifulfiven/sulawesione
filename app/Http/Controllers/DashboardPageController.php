<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\timpenggunas;

class DashboardPageController extends Controller
{
    public function index()
    {
        //$products = Product::latest()->paginate(5);
        //$berita = Berita::latest()->paginate(5);
        //$kegiatan = Kegiatan::latest()->paginate(5);
        $berita = "Berita";
        $toptitle = "Dashboard";
        // $header     = true;
        // $ceritalain = true;
        // $navhalaman = false;


        if(session('berhasil_login_operator', false)){
            $jumlahtiminti              = timpenggunas::where('jenistim', 'a')->count();
            $jumlahtimpendukung         = timpenggunas::where('jenistim', 'b')->count();
            $jumlahtimintihariini       = timpenggunas::where('jenistim', 'a')
                                        ->where('created_at', '>=', today())
                                        ->count();
            $jumlahtimpendukunghariini = timpenggunas::whereDate('created_at', today())
                                        ->where('jenistim', 'b')
                                        ->count();

            //ambil total jumlah pemilih berdasarkan id_dapil dan tampilkan nama kandidat
            $totalPemilih = \DB::table('pemilihs')
                ->count();

            $pemilihHariIni = \DB::table('pemilihs')
            ->whereDate('created_at', today())
                ->count();


                $pemilihDapil = \DB::table('pemilihs')
                                ->select('kandidats.namakandidat as name', \DB::raw('count(*) as jumlah_pemilih'))
                                ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
                                ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
                                ->groupBy('pemilihs.id_dapil', 'kandidats.namakandidat')
                                ->get();

        }elseif(session('berhasil_login_admins', false)){
            $jumlahtiminti              = timpenggunas::where('id_dapil', session('id_dapil'))->where('jenistim', 'a')->count();
            $jumlahtimpendukung         = timpenggunas::where('id_dapil', session('id_dapil'))->where('jenistim', 'b')->count();
            $jumlahtimintihariini       = timpenggunas::where('id_dapil', session('id_dapil'))->where('jenistim', 'a')
                                        ->where('created_at', '>=', today())
                                        ->count();
            $jumlahtimpendukunghariini = timpenggunas::where('id_dapil', session('id_dapil'))->whereDate('created_at', today())
                                        ->where('jenistim', 'b')
                                        ->count();
                                        $totalPemilih = \DB::table('pemilihs')
                                        ->where('id_dapil', session('id_dapil'))
                                        ->count();

            //ambil total jumlah pemilih berdasarkan id_dapil dan tampilkan nama kandidat
            $totalPemilih = \DB::table('pemilihs')
            ->where('id_dapil', session('id_dapil'))
            ->count();

        $pemilihHariIni = \DB::table('pemilihs')
            ->where('id_dapil', session('id_dapil'))
            ->whereDate('created_at', today())
            ->count();

            if(session('jeniskandidat') == 'pilkab'){
                $pemilihDapil = \DB::table('pemilihs')
                    ->select('districts.name', \DB::raw('count(*) as jumlah_pemilih'))
                    ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
                    ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
                    ->where('dapils.id', session('id_dapil'))
                    ->groupBy('pemilihs.id_kecamatan', 'districts.name')
                    ->get();
            }elseif(session('jeniskandidat') == 'pilgub'){
                $pemilihDapil = \DB::table('pemilihs')
                    ->select('regencies.name', \DB::raw('count(*) as jumlah_pemilih'))
                    ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
                    ->join('regencies', 'pemilihs.id_kabupaten', '=', 'regencies.id')
                    ->where('dapils.id', session('id_dapil'))
                    ->groupBy('pemilihs.id_kabupaten', 'regencies.name')
                    ->get();
            }

        }


        $data = [
            'jumlahtiminti'              => $jumlahtiminti,
            'jumlahtimpendukung'         => $jumlahtimpendukung,
            'jumlahtimintihariini'       => $jumlahtimintihariini,
            'jumlahtimpendukunghariini'  => $jumlahtimpendukunghariini,
            'totalPemilih'               => $totalPemilih,
            'pemilihHariIni'             => $pemilihHariIni,
        ];


        //kirim variabel ke view
        return view('admindashboard.index', compact('data','berita','toptitle','pemilihDapil'));
        //return view('landingpage.layout');
    }
}
