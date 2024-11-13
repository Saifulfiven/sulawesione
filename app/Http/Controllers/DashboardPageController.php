<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timpenggunas;

class DashboardPageController extends Controller
{
    public function index()
    {
        $berita = "Berita";
        $toptitle = "Dashboard";


        if(session('berhasil_login_operator', false)){
            $jumlahtiminti              = Timpenggunas::where('jenistim', 'a')->count();
            $jumlahtimpendukung         = Timpenggunas::where('jenistim', 'b')->count();
            $jumlahtimintihariini       = Timpenggunas::where('jenistim', 'a')
                                        ->where('created_at', '>=', today())
                                        ->count();
            $jumlahtimpendukunghariini = Timpenggunas::whereDate('created_at', today())
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
            $jumlahtiminti              = Timpenggunas::where('id_dapil', session('id_dapil'))->where('jenistim', 'a')->count();
            $jumlahtimpendukung         = Timpenggunas::where('id_dapil', session('id_dapil'))->where('jenistim', 'b')->count();
            $jumlahtimintihariini       = Timpenggunas::where('id_dapil', session('id_dapil'))->where('jenistim', 'a')
                                        ->where('created_at', '>=', today())
                                        ->count();
            $jumlahtimpendukunghariini = Timpenggunas::where('id_dapil', session('id_dapil'))->whereDate('created_at', today())
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

    public function grafiksuara()
    {
        $berita = "Berita";
        $toptitle = "Dashboard";


            //ambil total jumlah pemilih berdasarkan id_dapil dan tampilkan nama kandidat
            $totalPemilih = \DB::table('pemilihs')
            ->where('id_dapil', session('id_dapil'))
            ->count();

        $pemilihHariIni = \DB::table('pemilihs')
            ->where('id_dapil', session('id_dapil'))
            ->whereDate('created_at', today())
            ->count();

           // Gubernur
                $pemilihDapil = \DB::table('pemilihs')
                    ->select('regencies.name', \DB::raw('count(*) as jumlah_pemilih'))
                    ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
                    ->join('regencies', 'pemilihs.id_kabupaten', '=', 'regencies.id')
                    ->where('dapils.id', '5')
                    ->groupBy('pemilihs.id_kabupaten', 'regencies.name')
                    ->get();

                    // $pemilihDapil = \DB::table('pemilihs')
                    // ->select('districts.name', \DB::raw('count(*) as jumlah_pemilih'))
                    // ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
                    // ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
                    // ->where('dapils.id', 6)
                    // ->groupBy('pemilihs.id_kecamatan', 'districts.name')
                    // ->get();

        $data = [
            'totalPemilih'               => $totalPemilih,
            'pemilihHariIni'             => $pemilihHariIni,
        ];


        //kirim variabel ke view
        return view('admindashboard.indexgrafiksuara', compact('data','berita','toptitle','pemilihDapil'));
        //return view('landingpage.layout');
    }


    public function grafiksuarakab()
    {
        
        $berita = "Berita";
        $toptitle = "Dashboard";


            //ambil total jumlah pemilih berdasarkan id_dapil dan tampilkan nama kandidat
            $totalPemilih = \DB::table('pemilihs')
            ->where('id_dapil', session('id_dapil'))
            ->count();

        $pemilihHariIni = \DB::table('pemilihs')
            ->where('id_dapil', session('id_dapil'))
            ->whereDate('created_at', today())
            ->count();

           // Gubernur
                $pemilihDapil = \DB::table('pemilihs')
                    ->select('districts.name', \DB::raw('count(*) as jumlah_pemilih'))
                    ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
                    ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
                    ->where('dapils.id', '6')
                    ->groupBy('pemilihs.id_kecamatan', 'districts.name')
                    ->get();

                    // $pemilihDapil = \DB::table('pemilihs')
                    // ->select('districts.name', \DB::raw('count(*) as jumlah_pemilih'))
                    // ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
                    // ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
                    // ->where('dapils.id', 6)
                    // ->groupBy('pemilihs.id_kecamatan', 'districts.name')
                    // ->get();

        $data = [
            'totalPemilih'               => $totalPemilih,
            'pemilihHariIni'             => $pemilihHariIni,
        ];


        //kirim variabel ke view
        return view('admindashboard.indexgrafiksuarakab', compact('data','berita','toptitle','pemilihDapil'));
        //return view('landingpage.layout');
    }
}
