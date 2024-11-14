<?php

namespace App\Http\Controllers;

use App\Models\Districts;
use App\Models\Regencies;
use App\Models\Villages;
use Illuminate\Http\Request;
use App\Models\timintis;
use App\Models\pemilihs;
use App\Models\pendukungs;
use App\Models\Provinces;
use App\Models\kandidat;
use App\Models\Desa;
use App\Models\Timpenggunas;
use Illuminate\Support\Facades\DB; // Import DB class

class MasterPageController extends Controller
{
    // Landing Page
    public function index()
    {
        //$products = Product::latest()->paginate(5);
        //$master = master::latest()->paginate(5);
        //$kegiatan = Kegiatan::latest()->paginate(5);
        $master = "master";
        $header = false;
        return view('master.index', compact('master','header'));
        //return view('landingpage.layout');
    }


    //Dashboard

    public function timinti()
    {
        //$products = Product::latest()->paginate(5);
        //$master = master::latest()->paginate(5);
        //$kegiatan = Kegiatan::latest()->paginate(5);
        $toptitle = "Tim Inti";
        $header = false;

        if (session('berhasil_login_operator')) {
            $timintis = Timpenggunas::where('timpenggunas.jenistim', 'A')
                ->where('timpenggunas.id_dapil', 6) // Tampilkan hanya dari dapil 6
                ->join('dapils', 'timpenggunas.id_dapil', '=', 'dapils.id')
                ->join('kandidats', 'kandidats.id', '=', 'dapils.id_kandidat')
                ->join('regencies', 'regencies.id', '=', 'dapils.id_kabupaten')
                ->join('districts', 'timpenggunas.id_kecamatan', '=', 'districts.id') // Tambahkan join kecamatan
                ->select('timpenggunas.nama','timpenggunas.kontak','timpenggunas.username',
                    'kandidats.namakandidat','regencies.name as namakabupaten', 'districts.name as namakecamatan') // Tambahkan nama kecamatan
                ->orderBy('kandidats.namakandidat', 'asc') // Order by namakandidat
                ->get();
        } elseif (session('berhasil_login_admins')) {
            $dapil = session('id_dapil');
            $timintis = Timpenggunas::where('timpenggunas.jenistim', 'A')
                ->where('timpenggunas.id_dapil', $dapil)
                ->join('dapils', 'timpenggunas.id_dapil', '=', 'dapils.id')
                ->join('kandidats', 'kandidats.id', '=', 'dapils.id_kandidat')
                ->join('regencies', 'regencies.id', '=', 'dapils.id_kabupaten')
                ->join('districts', 'timpenggunas.id_kecamatan', '=', 'districts.id') // Tambahkan join kecamatan
                ->select('timpenggunas.nama','timpenggunas.kontak','timpenggunas.username',
                    'kandidats.namakandidat','regencies.name as namakabupaten', 'districts.name as namakecamatan')
                ->orderBy('kandidats.namakandidat', 'asc') // Order by namakandidat
                ->get();
        }

        return view('master.timinti', compact('header','toptitle','timintis'));
        //return view('landingpage.layout');
    }

    public function pendukung()
    {
        //$products = Product::latest()->paginate(5);
        //$master = master::latest()->paginate(5);
        //$kegiatan = Kegiatan::latest()->paginate(5);
        $toptitle = "Pendukung";
        $header = false;


        if (session('berhasil_login_operator')) {
        $pendukungs = Pemilihs::where('pemilihs.jenis_suara', '2')
                                ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
                                ->join('kandidats', 'kandidats.id', '=', 'dapils.id_kandidat')
                                ->join('regencies', 'regencies.id', '=', 'dapils.id_kabupaten')
                                ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id') // Tambahkan join kecamatan
                                ->select('pemilihs.nama','pemilihs.kontak',
                                    'kandidats.namakandidat','regencies.name as namakabupaten', 'districts.name as namakecamatan','pemilihs.kodetim')
                                ->orderBy('kandidats.namakandidat', 'asc')
                                ->get();
        } elseif (session('berhasil_login_admins')) {
        $dapil = session('id_dapil');

        $pendukungs = Pemilihs::where('pemilihs.jenis_suara', '2')
                                ->join('dapils', 'timpenggunas.id_dapil', '=', 'dapils.id')
                                ->join('kandidats', 'kandidats.id', '=', 'dapils.id_kandidat')
                                ->join('regencies', 'regencies.id', '=', 'dapils.id_kabupaten')
                                ->join('districts', 'timpenggunas.id_kecamatan', '=', 'districts.id') // Tambahkan join kecamatan

                                ->where('timpenggunas.id_dapil', $dapil)
                                ->select('timpenggunas.nama','timpenggunas.kontak','timpenggunas.username',
                                    'kandidats.namakandidat','regencies.name as namakabupaten', 'districts.name as namakecamatan','pemilihs.kodetim')
                                ->orderBy('kandidats.namakandidat', 'asc')
                                ->get();
        }

       return view('master.pendukung', compact('header','toptitle','pendukungs'));
        //return view('landingpage.layout');
    }


    // PILGUB
    public function timintipilgub()
    {
        //$products = Product::latest()->paginate(5);
        //$master = master::latest()->paginate(5);
        //$kegiatan = Kegiatan::latest()->paginate(5);
        $toptitle = "Tim Inti Pilgub";
        $header = false;

        $timintipilgubs = Timpenggunas::where('timpenggunas.jenistim', '=','A')
                                ->join('dapils', 'timpenggunas.id_dapil', '=', 'dapils.id')
                                ->join('kandidats', 'kandidats.id', '=', 'dapils.id_kandidat')
                                ->join('provinces', 'provinces.id', '=', 'dapils.id_provinsi')
                                ->join('regencies', 'timpenggunas.id_kabupaten', '=', 'regencies.id')
                                ->orderBy('provinces.id', 'asc')
                                ->select('timpenggunas.nama','timpenggunas.kontak','timpenggunas.username','kandidats.namakandidat',
                                    'provinces.name as namaprovinsi','regencies.name as namakabupaten')->get();
        //return $timintipilgubs;
        return view('master.timintipilgub', compact('header','toptitle','timintipilgubs'));
        //return view('landingpage.layout');
    }

    public function pendukungpilgub()
    {
        //$products = Product::latest()->paginate(5);
        //$master = master::latest()->paginate(5);
        //$kegiatan = Kegiatan::latest()->paginate(5);
        $toptitle = "Tim Pendukung Pilgub";
        $header = false;


        $pendukungpilgubs = DB::table('pemilihs')
                                ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
                                ->join('kandidats', 'kandidats.id', '=', 'dapils.id_kandidat')
                                ->join('provinces', 'provinces.id', '=', 'pemilihs.id_provinsi')
                                ->join('regencies', 'pemilihs.id_kabupaten', '=', 'regencies.id')
                                ->select('pemilihs.nama','pemilihs.kontak','kandidats.namakandidat',
                                         'regencies.name as namakabupaten','provinces.name as namaprovinsi','pemilihs.kodetim')
                                         ->Where('pemilihs.jenis_suara','=','2')
                                ->where('pemilihs.jenis_suara','=','2')->get();
       //return $pendukungpilgubs;
        return view('master.pendukungpilgub', compact('header','toptitle','pendukungpilgubs'));
        //return view('landingpage.layout');
    }


    // Search Kabupaten
    public function searchkabupaten(Request $request)
    {
        $regencies = Regencies::select('id','name as namakabupaten')
                                ->where('province_id',$request->id_provinsi)->get();
        return response()->json($regencies);
    }

    // Search Kecamatan
    public function searchkecamatan(Request $request)
    {
        $kecamatan = Districts::select('id','name as namakecamatan')
                                ->where('regency_id',$request->id_kabupaten)->get();
        return response()->json($kecamatan);
    }

    // Search Desa
    public function searchdesa(Request $request)
    {
        $desa = Villages::select('id','name as namadesa')
            ->where('district_id',$request->id_kecamatan)->get();
        return response()->json($desa);
    }


    public function searchpemilih(Request $request)
    {
        $id_provinsi  = $request->id_provinsi;
        $id_kabupaten = $request->id_kabupaten;
        $id_kecamatan = $request->id_kecamatan;
        $id_desa      = $request->id_desa;
        $id_dapil     = $request->id_kandidat;

        // Pemilihs Untuk tampilkan di tabel  ====== pemilihdapil tampilkan di grafik dan samping
        $namakab = 'pilkab';
        if($id_desa != '0'){
            $pemilihs = DB::table('pemilihs')
                ->join('provinces', 'pemilihs.id_provinsi', '=', 'provinces.id')
                ->join('regencies', 'pemilihs.id_kabupaten', '=', 'regencies.id')
                ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
                ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
                ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
                ->join('villages', 'pemilihs.id_desa', '=', 'villages.id')
                ->join('timpenggunas', 'pemilihs.id_timpengguna', '=', 'timpenggunas.id') // Added join to table kandidats
                     ->select('pemilihs.nama','pemilihs.kontak','pemilihs.jenispilihan','pemilihs.created_at','villages.name as namadesa',
                    'districts.name as namakecamatan','regencies.name as namakabupaten','provinces.name as namaprovinsi',
                    'kandidats.namakandidat',
                    'timpenggunas.nama as namapengguna')
                ->where('pemilihs.id_provinsi', '=', $id_provinsi)
                ->Where('pemilihs.id_kabupaten', '=', $id_kabupaten)
                ->Where('pemilihs.id_kecamatan', '=', $id_kecamatan)
                ->Where('pemilihs.id_desa', '=', $id_desa)
                ->Where('pemilihs.id_dapil', '=', $id_dapil)
                ->Where('dapils.jeniskandidat','=','pilkab')->get();
                
                $pemilihdapil = \DB::table('pemilihs')
                ->select('villages.name as namakecamatan', \DB::raw('count(*) as jumlah_pemilih'))
                ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
                ->join('villages', 'pemilihs.id_desa', '=', 'villages.id')
                ->where('dapils.jeniskandidat', '=', "'pilkab'")
                ->where('pemilihs.id_provinsi', '=', $id_provinsi)
                ->where('pemilihs.id_kabupaten', '=', $id_kabupaten)
                ->Where('pemilihs.id_kecamatan', '=', $id_kecamatan)
                ->Where('pemilihs.id_desa', '=', $id_desa)
                ->Where('pemilihs.id_dapil', '=', $id_dapil)
                ->groupBy('pemilihs.id_desa')->get();
        }else if($id_kecamatan != '0'){
            $pemilihs = DB::table('pemilihs')
                ->join('provinces', 'pemilihs.id_provinsi', '=', 'provinces.id')
                ->join('regencies', 'pemilihs.id_kabupaten', '=', 'regencies.id')
                ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
                ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
                ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
                ->join('villages', 'pemilihs.id_desa', '=', 'villages.id')
                ->join('timpenggunas', 'pemilihs.id_timpengguna', '=', 'timpenggunas.id') // Added join to table kandidats
                     ->select('pemilihs.nama','pemilihs.kontak','pemilihs.jenispilihan','pemilihs.created_at','villages.name as namadesa',
                    'districts.name as namakecamatan','regencies.name as namakabupaten','provinces.name as namaprovinsi',
                    'kandidats.namakandidat',
                    'timpenggunas.nama as namapengguna')
                ->where('pemilihs.id_provinsi', '=', $id_provinsi)
                ->Where('pemilihs.id_kabupaten', '=', $id_kabupaten)
                ->Where('pemilihs.id_kecamatan', '=', $id_kecamatan)
                ->Where('pemilihs.id_dapil', '=', $id_dapil)
                ->Where('dapils.jeniskandidat','=','pilkab')->get();
                
                $pemilihdapil = \DB::table('pemilihs')
                ->select('villages.name as namakecamatan', \DB::raw('count(*) as jumlah_pemilih'))
                ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
                ->join('villages', 'pemilihs.id_desa', '=', 'villages.id')
                ->where('dapils.jeniskandidat', '=', $namakab)
                ->where('pemilihs.id_provinsi', '=', $id_provinsi)
                ->where('pemilihs.id_kabupaten', '=', $id_kabupaten)
                ->Where('pemilihs.id_kecamatan', '=', $id_kecamatan)
                ->Where('pemilihs.id_dapil', '=', $id_dapil)
                ->groupBy('pemilihs.id_desa')->get();
        }else if ($id_kabupaten != '0'){
            $pemilihs = DB::table('pemilihs')
                ->join('provinces', 'pemilihs.id_provinsi', '=', 'provinces.id')
                ->join('regencies', 'pemilihs.id_kabupaten', '=', 'regencies.id')
                ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
                ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
                ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
                ->join('villages', 'pemilihs.id_desa', '=', 'villages.id')
                ->join('timpenggunas', 'pemilihs.id_timpengguna', '=', 'timpenggunas.id') // Added join to table kandidats
                    ->select('pemilihs.nama','pemilihs.kontak','pemilihs.jenispilihan','pemilihs.created_at','villages.name as namadesa',
                    'districts.name as namakecamatan','regencies.name as namakabupaten','provinces.name as namaprovinsi',
                    'kandidats.namakandidat',
                    'timpenggunas.nama as namapengguna')
                ->where('pemilihs.id_provinsi', '=', $id_provinsi)
                ->Where('pemilihs.id_kabupaten', '=', $id_kabupaten)
                ->Where('pemilihs.id_dapil', '=', $id_dapil)
                ->Where('dapils.jeniskandidat','=',"'pilkab'")->get();
                
                $pemilihdapil = \DB::table('pemilihs')
                ->select('districts.name as namakecamatan', \DB::raw('count(*) as jumlah_pemilih'))
                ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
                ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
                ->where('dapils.jeniskandidat', '=', "'pilkab'")
                ->where('pemilihs.id_provinsi', '=', $id_provinsi)
                ->where('pemilihs.id_kabupaten', '=', $id_kabupaten)
                ->Where('pemilihs.id_dapil', '=', $id_dapil)->get();
        }else if ($id_provinsi != null){
            $pemilihs = DB::table('pemilihs')
                ->join('provinces', 'pemilihs.id_provinsi', '=', 'provinces.id')
                ->join('regencies', 'pemilihs.id_kabupaten', '=', 'regencies.id')
                ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
                ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
                ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
                ->join('villages', 'pemilihs.id_desa', '=', 'villages.id')
                ->join('timpenggunas', 'pemilihs.id_timpengguna', '=', 'timpenggunas.id') // Added join to table kandidats
                    ->select('pemilihs.nama','pemilihs.kontak','pemilihs.jenispilihan','pemilihs.created_at','villages.name as namadesa',
                    'districts.name as namakecamatan','regencies.name as namakabupaten','provinces.name as namaprovinsi',
                    'kandidats.namakandidat',
                    'timpenggunas.nama as namapengguna')
                ->where('pemilihs.id_provinsi', '=', $id_provinsi)
                ->Where('pemilihs.id_dapil', '=', $id_dapil)
                ->Where('dapils.jeniskandidat','=','pilkab')->get();
                
                $pemilihdapil = \DB::table('pemilihs')
                ->select('districts.name as namakecamatan', \DB::raw('count(*) as jumlah_pemilih'))
                ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
                ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
                ->where('dapils.jeniskandidat', '=', 'pilkab')
                ->where('pemilihs.id_provinsi', '=', $id_provinsi)
                ->Where('pemilihs.id_dapil', '=', $id_dapil)
                ->Where('dapils.jeniskandidat','=','pilkab')
                ->groupBy('pemilihs.id_kecamatan')->get();
        }
            

        return response()->json(['pemilihs' => $pemilihs, 'pemilihdapil' => $pemilihdapil]);
    }

// Searching Pilgub Berdasarkan jumlah Suara
    public function searchpemilihgub(Request $request)
    {
        $id_provinsi = $request->id_provinsi;
        $id_kabupaten = $request->id_kabupaten;
        $id_kecamatan = $request->id_kecamatan;
        $id_dapil     = $request->id_kandidat;
        $id_desa     = $request->id_desa;

        // Pemilihs Untuk tampilkan di tabel  ====== pemilihdapil tampilkan di grafik dan samping
        
        if($id_desa != '0'){
            $pemilihs = DB::table('pemilihs')
                ->join('provinces', 'pemilihs.id_provinsi', '=', 'provinces.id')
                ->join('regencies', 'pemilihs.id_kabupaten', '=', 'regencies.id')
                ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
                ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
                ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
                ->join('villages', 'pemilihs.id_desa', '=', 'villages.id')
                ->join('timpenggunas', 'pemilihs.id_timpengguna', '=', 'timpenggunas.id') // Added join to table kandidats
                     ->select('pemilihs.nama','pemilihs.kontak','pemilihs.jenispilihan','pemilihs.created_at','villages.name as namadesa',
                    'districts.name as namakecamatan','regencies.name as namakabupaten','provinces.name as namaprovinsi',
                    'kandidats.namakandidat',
                    'timpenggunas.nama as namapengguna',
                    'pemilihs.kodetim')
                ->where('pemilihs.id_provinsi', '=', $id_provinsi)
                ->Where('pemilihs.id_kabupaten', '=', $id_kabupaten)
                ->Where('pemilihs.id_kecamatan', '=', $id_kecamatan)
                ->Where('pemilihs.id_desa', '=', $id_desa)
                ->Where('pemilihs.id_dapil', '=', $id_dapil)
                ->Where('dapils.jeniskandidat','=','pilgub')->get();
                
                $pemilihdapil = \DB::table('pemilihs')
                ->select('villages.name as namakecamatan', \DB::raw('count(*) as jumlah_pemilih'))
                ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
                ->join('villages', 'pemilihs.id_desa', '=', 'villages.id')
                ->where('dapils.jeniskandidat', '=', 'pilgub')
                ->where('pemilihs.id_provinsi', '=', $id_provinsi)
                ->where('pemilihs.id_kabupaten', '=', $id_kabupaten)
                ->Where('pemilihs.id_kecamatan', '=', $id_kecamatan)
                ->Where('pemilihs.id_desa', '=', $id_desa)
                ->Where('pemilihs.id_dapil', '=', $id_dapil)
                ->Where('dapils.jeniskandidat','=','pilgub')
                ->groupBy('pemilihs.id_desa')
                ->groupBy('villages.name')
                ->get();
        }elseif($id_kecamatan != '0'){
            $pemilihs = DB::table('pemilihs')
                ->join('provinces', 'pemilihs.id_provinsi', '=', 'provinces.id')
                ->join('regencies', 'pemilihs.id_kabupaten', '=', 'regencies.id')
                ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
                ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
                ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
                ->join('villages', 'pemilihs.id_desa', '=', 'villages.id')
                ->join('timpenggunas', 'pemilihs.id_timpengguna', '=', 'timpenggunas.id') // Added join to table kandidats
                     ->select('pemilihs.nama','pemilihs.kontak','pemilihs.jenispilihan','pemilihs.created_at','villages.name as namadesa',
                    'districts.name as namakecamatan','regencies.name as namakabupaten','provinces.name as namaprovinsi',
                    'kandidats.namakandidat',
                    'timpenggunas.nama as namapengguna','pemilihs.kodetim')
                ->where('pemilihs.id_provinsi', '=', $id_provinsi)
                ->Where('pemilihs.id_kabupaten', '=', $id_kabupaten)
                ->Where('pemilihs.id_kecamatan', '=', $id_kecamatan)
                ->Where('pemilihs.id_dapil', '=', $id_dapil)
                ->Where('dapils.jeniskandidat','=','pilgub')->get();
                
                $pemilihdapil = \DB::table('pemilihs')
                ->select('villages.name as namakecamatan', \DB::raw('count(*) as jumlah_pemilih'))
                ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
                ->join('villages', 'pemilihs.id_desa', '=', 'villages.id')
                ->where('dapils.jeniskandidat', '=', 'pilgub')
                ->where('pemilihs.id_provinsi', '=', $id_provinsi)
                ->where('pemilihs.id_kabupaten', '=', $id_kabupaten)
                ->Where('pemilihs.id_kecamatan', '=', $id_kecamatan)
                ->Where('pemilihs.id_dapil', '=', $id_dapil)
                ->Where('dapils.jeniskandidat','=','pilgub')
                ->groupBy('pemilihs.id_desa')
                ->groupBy('villages.name')->get();
        }else if ($id_kabupaten != '0'){
            $pemilihs = DB::table('pemilihs')
                ->join('provinces', 'pemilihs.id_provinsi', '=', 'provinces.id')
                ->join('regencies', 'pemilihs.id_kabupaten', '=', 'regencies.id')
                ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
                ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
                ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
                ->join('villages', 'pemilihs.id_desa', '=', 'villages.id')
                ->join('timpenggunas', 'pemilihs.id_timpengguna', '=', 'timpenggunas.id') // Added join to table kandidats
                    ->select('pemilihs.nama','pemilihs.kontak','pemilihs.jenispilihan','pemilihs.created_at','villages.name as namadesa',
                    'districts.name as namakecamatan','regencies.name as namakabupaten','provinces.name as namaprovinsi',
                    'kandidats.namakandidat',
                    'timpenggunas.nama as namapengguna','pemilihs.kodetim')
                ->where('pemilihs.id_provinsi', '=', $id_provinsi)
                ->Where('pemilihs.id_kabupaten', '=', $id_kabupaten)
                ->Where('pemilihs.id_dapil', '=', $id_dapil)
                ->Where('dapils.jeniskandidat','=','pilgub')->get();
                
                $pemilihdapil = \DB::table('pemilihs')
                ->select('districts.name as namakecamatan', \DB::raw('count(*) as jumlah_pemilih'))
                ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
                ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
                ->where('dapils.jeniskandidat', '=', 'pilgub')
                ->where('pemilihs.id_provinsi', '=', $id_provinsi)
                ->where('pemilihs.id_kabupaten', '=', $id_kabupaten)
                ->Where('pemilihs.id_dapil', '=', $id_dapil)
                ->Where('dapils.jeniskandidat','=','pilgub')
                ->groupBy('districts.name')
                ->groupBy('pemilihs.id_kecamatan')->get();
        }else if ($id_provinsi != null){
            $pemilihs = DB::table('pemilihs')
                ->join('provinces', 'pemilihs.id_provinsi', '=', 'provinces.id')
                ->join('regencies', 'pemilihs.id_kabupaten', '=', 'regencies.id')
                ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
                ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
                ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
                ->join('villages', 'pemilihs.id_desa', '=', 'villages.id')
                ->join('timpenggunas', 'pemilihs.id_timpengguna', '=', 'timpenggunas.id') // Added join to table kandidats
                    ->select('pemilihs.nama','pemilihs.kontak','pemilihs.jenispilihan','pemilihs.created_at','villages.name as namadesa',
                    'districts.name as namakecamatan','regencies.name as namakabupaten','provinces.name as namaprovinsi',
                    'kandidats.namakandidat',
                    'timpenggunas.nama as namapengguna','pemilihs.kodetim')
                ->where('pemilihs.id_provinsi', '=', $id_provinsi)
                ->Where('pemilihs.id_dapil', '=', $id_dapil)
                ->Where('dapils.jeniskandidat','=','pilgub')->get();
                
                $pemilihdapil = \DB::table('pemilihs')
                ->select('districts.name as namakecamatan', \DB::raw('count(*) as jumlah_pemilih'))
                ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
                ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
                ->where('dapils.jeniskandidat', '=', 'pilgub')
                ->where('pemilihs.id_provinsi', '=', $id_provinsi)
                ->Where('pemilihs.id_dapil', '=', $id_dapil)
                ->Where('dapils.jeniskandidat','=','pilgub')
                ->groupBy('pemilihs.id_kecamatan')
                ->groupBy('districts.name')
                ->get();
        }
            

        return response()->json(['pemilihs' => $pemilihs, 'pemilihdapil' => $pemilihdapil]);
    }


// Searching Pilgub Berdasarkan jumlah Suara bobot
public function searchpemilihgubbobot(Request $request)
{
    $id_dapil       = $request->id_kandidat;
    $id_provinsi    = $request->id_provinsi;
    $id_kabupaten   = $request->id_kabupaten;
    $id_kecamatan   = $request->id_kecamatan;
    $id_desa        = $request->id_desa;

    // Pemilihs Untuk tampilkan di tabel  ====== pemilihdapil tampilkan di grafik dan samping
    
    if($id_desa != '0'){
        $pemilihs = DB::table('pemilihs')
            ->join('provinces', 'pemilihs.id_provinsi', '=', 'provinces.id')
            ->join('regencies', 'pemilihs.id_kabupaten', '=', 'regencies.id')
            ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
            ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
            ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
            ->join('villages', 'pemilihs.id_desa', '=', 'villages.id')
            ->join('timpenggunas', 'pemilihs.id_timpengguna', '=', 'timpenggunas.id') // Added join to table kandidats
                 ->select('pemilihs.nama','pemilihs.kontak','pemilihs.jenispilihan','pemilihs.created_at','villages.name as namadesa',
                'districts.name as namakecamatan','regencies.name as namakabupaten','provinces.name as namaprovinsi',
                'kandidats.namakandidat',
                'timpenggunas.nama as namapengguna','pemilihs.kodetim')
            ->where('pemilihs.id_provinsi', '=', $id_provinsi)
            ->Where('pemilihs.id_kabupaten', '=', $id_kabupaten)
            ->Where('pemilihs.id_kecamatan', '=', $id_kecamatan)
            ->Where('pemilihs.id_desa', '=', $id_desa)
            ->Where('pemilihs.id_dapil', '=', $id_dapil)
            ->Where('dapils.jeniskandidat','=','pilgub')->get();

        
        $pemilihdapilbobot = \DB::table('pemilihs')
        ->select('pemilihs.jenispilihan as namakecamatan', \DB::raw('count(*) as jumlah_pemilih'))
        ->where('pemilihs.id_provinsi', '=', $id_provinsi)
        ->where('pemilihs.id_kabupaten', '=', $id_kabupaten)
        ->where('pemilihs.id_kecamatan', '=', $id_kecamatan)
        ->Where('pemilihs.id_desa', '=', $id_desa)
        ->where('pemilihs.id_dapil', '=', $id_dapil)
        ->groupBy('pemilihs.jenispilihan')
        ->get();
        

            
    }elseif($id_kecamatan != '0'){
        $pemilihs = DB::table('pemilihs')
            ->join('provinces', 'pemilihs.id_provinsi', '=', 'provinces.id')
            ->join('regencies', 'pemilihs.id_kabupaten', '=', 'regencies.id')
            ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
            ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
            ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
            ->join('villages', 'pemilihs.id_desa', '=', 'villages.id')
            ->join('timpenggunas', 'pemilihs.id_timpengguna', '=', 'timpenggunas.id') // Added join to table kandidats
                 ->select('pemilihs.nama','pemilihs.kontak','pemilihs.jenispilihan','pemilihs.created_at','villages.name as namadesa',
                'districts.name as namakecamatan','regencies.name as namakabupaten','provinces.name as namaprovinsi',
                'kandidats.namakandidat',
                'timpenggunas.nama as namapengguna','pemilihs.kodetim')
            ->where('pemilihs.id_provinsi', '=', $id_provinsi)
            ->Where('pemilihs.id_kabupaten', '=', $id_kabupaten)
            ->Where('pemilihs.id_kecamatan', '=', $id_kecamatan)
            ->Where('pemilihs.id_dapil', '=', $id_dapil)
            ->Where('dapils.jeniskandidat','=','pilgub')->get();

        
        $pemilihdapilbobot = \DB::table('pemilihs')
        ->select('pemilihs.jenispilihan as namakecamatan', \DB::raw('count(*) as jumlah_pemilih'))
        ->where('pemilihs.id_provinsi', '=', $id_provinsi)
        ->where('pemilihs.id_kabupaten', '=', $id_kabupaten)
        ->where('pemilihs.id_kecamatan', '=', $id_kecamatan)
        ->where('pemilihs.id_dapil', '=', $id_dapil)
        ->groupBy('pemilihs.jenispilihan')
        ->get();
        

            
    }else if ($id_kabupaten != '0'){
        $pemilihs = DB::table('pemilihs')
            ->join('provinces', 'pemilihs.id_provinsi', '=', 'provinces.id')
            ->join('regencies', 'pemilihs.id_kabupaten', '=', 'regencies.id')
            ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
            ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
            ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
            ->join('villages', 'pemilihs.id_desa', '=', 'villages.id')
            ->join('timpenggunas', 'pemilihs.id_timpengguna', '=', 'timpenggunas.id') // Added join to table kandidats
                ->select('pemilihs.nama','pemilihs.kontak','pemilihs.jenispilihan','pemilihs.created_at','villages.name as namadesa',
                'districts.name as namakecamatan','regencies.name as namakabupaten','provinces.name as namaprovinsi',
                'kandidats.namakandidat',
                'timpenggunas.nama as namapengguna','pemilihs.kodetim')
            ->where('pemilihs.id_provinsi', '=', $id_provinsi)
            ->Where('pemilihs.id_kabupaten', '=', $id_kabupaten)
            ->Where('pemilihs.id_dapil', '=', $id_dapil)
            ->Where('dapils.jeniskandidat','=','pilgub')->get();
            
            
        $pemilihdapilbobot = \DB::table('pemilihs')
        ->select('pemilihs.jenispilihan as namakecamatan', \DB::raw('count(*) as jumlah_pemilih'))
        ->where('pemilihs.id_provinsi', '=', $id_provinsi)
        ->where('pemilihs.id_kabupaten', '=', $id_kabupaten)
        ->where('pemilihs.id_dapil', '=', $id_dapil)
        ->groupBy('pemilihs.jenispilihan')
        ->get();
    }else if ($id_provinsi != null){
        $pemilihs = DB::table('pemilihs')
            ->join('provinces', 'pemilihs.id_provinsi', '=', 'provinces.id')
            ->join('regencies', 'pemilihs.id_kabupaten', '=', 'regencies.id')
            ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
            ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
            ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
            ->join('villages', 'pemilihs.id_desa', '=', 'villages.id')
            ->join('timpenggunas', 'pemilihs.id_timpengguna', '=', 'timpenggunas.id') // Added join to table kandidats
                ->select('pemilihs.nama','pemilihs.kontak','pemilihs.jenispilihan','pemilihs.created_at','villages.name as namadesa',
                'districts.name as namakecamatan','regencies.name as namakabupaten','provinces.name as namaprovinsi',
                'kandidats.namakandidat',
                'timpenggunas.nama as namapengguna','pemilihs.kodetim')
            ->where('pemilihs.id_provinsi', '=', $id_provinsi)
            ->Where('pemilihs.id_dapil', '=', $id_dapil)
            ->Where('dapils.jeniskandidat','=','pilgub')->get();
            
            
        $pemilihdapilbobot = \DB::table('pemilihs')
        ->select('pemilihs.jenispilihan as namakecamatan', \DB::raw('count(*) as jumlah_pemilih'))
        ->where('pemilihs.id_provinsi', '=', $id_provinsi)
        ->where('pemilihs.id_dapil', '=', $id_dapil)
        ->groupBy('pemilihs.jenispilihan')
        ->get();
    }
        

    return response()->json(['pemilihsbobot' => $pemilihs, 'pemilihdapilbobot' => $pemilihdapilbobot]);
}


// Searching Pilgub Berdasarkan jumlah Suara collection
public function searchpemilihgubcollection(Request $request)
{
    $id_dapil       = $request->id_kandidat;
    $id_provinsi    = $request->id_provinsi;
    $id_kabupaten   = $request->id_kabupaten;
    $id_kecamatan   = $request->id_kecamatan;
    $id_desa        = $request->id_desa;

    // Pemilihs Untuk tampilkan di tabel  ====== pemilihdapil tampilkan di grafik dan samping
    
    if($id_desa != '0'){
        $pemilihs = DB::table('pemilihs')
            ->join('provinces', 'pemilihs.id_provinsi', '=', 'provinces.id')
            ->join('regencies', 'pemilihs.id_kabupaten', '=', 'regencies.id')
            ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
            ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
            ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
            ->join('villages', 'pemilihs.id_desa', '=', 'villages.id')
            ->join('timpenggunas', 'pemilihs.id_timpengguna', '=', 'timpenggunas.id') // Added join to table kandidats
            ->select('pemilihs.nama','pemilihs.kontak','pemilihs.jenispilihan','pemilihs.id_kandidat','pemilihs.rt','pemilihs.rw','pemilihs.created_at','villages.name as namadesa',
                'districts.name as namakecamatan','regencies.name as namakabupaten','provinces.name as namaprovinsi',
                'kandidats.namakandidat',
                'timpenggunas.nama as namapengguna','pemilihs.kodetim')
            ->where('pemilihs.id_provinsi', '=', $id_provinsi)
            ->Where('pemilihs.id_kabupaten', '=', $id_kabupaten)
            ->Where('pemilihs.id_kecamatan', '=', $id_kecamatan)
            ->Where('pemilihs.id_desa', '=', $id_desa)
            ->Where('pemilihs.id_dapil', '=', $id_dapil)
            ->Where('dapils.jeniskandidat','=','pilgub')->get();


        $pemilihdapilcollection = \DB::table('pemilihs')
        ->join('kandidatwilayahs', 'pemilihs.id_kandidat', '=', 'kandidatwilayahs.id')
        ->select('kandidatwilayahs.namakandidat', \DB::raw('count(*) as jumlah_pemilih'))
        ->where('pemilihs.id_provinsi', '=', $id_provinsi)
        ->where('pemilihs.id_kabupaten', '=', $id_kabupaten)
        ->where('pemilihs.id_kecamatan', '=', $id_kecamatan)
        ->Where('pemilihs.id_desa', '=', $id_desa)
        ->where('pemilihs.id_dapil', '=', $id_dapil)
        ->groupBy('pemilihs.id_kandidat', 'kandidatwilayahs.namakandidat')
        ->get();
        

            
    }elseif($id_kecamatan != '0'){
        $pemilihs = DB::table('pemilihs')
            ->join('provinces', 'pemilihs.id_provinsi', '=', 'provinces.id')
            ->join('regencies', 'pemilihs.id_kabupaten', '=', 'regencies.id')
            ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
            ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
            ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
            ->join('villages', 'pemilihs.id_desa', '=', 'villages.id')
            ->join('timpenggunas', 'pemilihs.id_timpengguna', '=', 'timpenggunas.id') // Added join to table kandidats
            ->select('pemilihs.nama','pemilihs.kontak','pemilihs.jenispilihan','pemilihs.id_kandidat','pemilihs.rt','pemilihs.rw','pemilihs.created_at','villages.name as namadesa',
                'districts.name as namakecamatan','regencies.name as namakabupaten','provinces.name as namaprovinsi',
                'kandidats.namakandidat',
                'timpenggunas.nama as namapengguna','pemilihs.kodetim')
            ->where('pemilihs.id_provinsi', '=', $id_provinsi)
            ->Where('pemilihs.id_kabupaten', '=', $id_kabupaten)
            ->Where('pemilihs.id_kecamatan', '=', $id_kecamatan)
            ->Where('pemilihs.id_dapil', '=', $id_dapil)
            ->Where('dapils.jeniskandidat','=','pilgub')->get();

        
        
        $pemilihdapilcollection = \DB::table('pemilihs')
        ->join('kandidatwilayahs', 'pemilihs.id_kandidat', '=', 'kandidatwilayahs.id')
        ->select('kandidatwilayahs.namakandidat', \DB::raw('count(*) as jumlah_pemilih'))
        ->where('pemilihs.id_provinsi', '=', $id_provinsi)
        ->where('pemilihs.id_kabupaten', '=', $id_kabupaten)
        ->where('pemilihs.id_kecamatan', '=', $id_kecamatan)
        ->where('pemilihs.id_dapil', '=', $id_dapil)
        ->groupBy('pemilihs.id_kandidat', 'kandidatwilayahs.namakandidat')
        ->get();
        

            
    }else if ($id_kabupaten != '0'){
        $pemilihs = DB::table('pemilihs')
            ->join('provinces', 'pemilihs.id_provinsi', '=', 'provinces.id')
            ->join('regencies', 'pemilihs.id_kabupaten', '=', 'regencies.id')
            ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
            ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
            ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
            ->join('villages', 'pemilihs.id_desa', '=', 'villages.id')
            ->join('timpenggunas', 'pemilihs.id_timpengguna', '=', 'timpenggunas.id') // Added join to table kandidats
            ->select('pemilihs.nama','pemilihs.kontak','pemilihs.jenispilihan','pemilihs.id_kandidat','pemilihs.rt','pemilihs.rw','pemilihs.created_at','villages.name as namadesa',
                'districts.name as namakecamatan','regencies.name as namakabupaten','provinces.name as namaprovinsi',
                'kandidats.namakandidat',
                'timpenggunas.nama as namapengguna','pemilihs.kodetim')
            ->where('pemilihs.id_provinsi', '=', $id_provinsi)
            ->Where('pemilihs.id_kabupaten', '=', $id_kabupaten)
            ->Where('pemilihs.id_dapil', '=', $id_dapil)
            ->Where('dapils.jeniskandidat','=','pilgub')->get();
            
          
        $pemilihdapilcollection = \DB::table('pemilihs')
        ->join('kandidatwilayahs', 'pemilihs.id_kandidat', '=', 'kandidatwilayahs.id')
        ->select('kandidatwilayahs.namakandidat', \DB::raw('count(*) as jumlah_pemilih'))
        ->where('pemilihs.id_provinsi', '=', $id_provinsi)
        ->where('pemilihs.id_kabupaten', '=', $id_kabupaten)
        ->where('pemilihs.id_dapil', '=', $id_dapil)
        ->groupBy('pemilihs.id_kandidat', 'kandidatwilayahs.namakandidat')
        ->get();

    }else if ($id_provinsi != null){
        $pemilihs = DB::table('pemilihs')
            ->join('provinces', 'pemilihs.id_provinsi', '=', 'provinces.id')
            ->join('regencies', 'pemilihs.id_kabupaten', '=', 'regencies.id')
            ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
            ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
            ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
            ->join('villages', 'pemilihs.id_desa', '=', 'villages.id')
            ->join('timpenggunas', 'pemilihs.id_timpengguna', '=', 'timpenggunas.id') // Added join to table kandidats
                ->select('pemilihs.nama','pemilihs.kontak','pemilihs.jenispilihan','pemilihs.id_kandidat','pemilihs.rt','pemilihs.rw','pemilihs.created_at','villages.name as namadesa',
                'districts.name as namakecamatan','regencies.name as namakabupaten','provinces.name as namaprovinsi',
                'kandidats.namakandidat',
                'timpenggunas.nama as namapengguna','pemilihs.kodetim')
            ->where('pemilihs.id_provinsi', '=', $id_provinsi)
            ->Where('pemilihs.id_dapil', '=', $id_dapil)
            ->Where('dapils.jeniskandidat','=','pilgub')->get();
            
            
        $pemilihdapilcollection = \DB::table('pemilihs')
        ->join('kandidatwilayahs', 'pemilihs.id_kandidat', '=', 'kandidatwilayahs.id')
        ->select('kandidatwilayahs.namakandidat', \DB::raw('count(*) as jumlah_pemilih'))
        ->where('pemilihs.id_provinsi', '=', $id_provinsi)
        ->where('pemilihs.id_dapil', '=', $id_dapil)
        ->groupBy('pemilihs.id_kandidat', 'kandidatwilayahs.namakandidat')
        ->get();
    }
        

    return response()->json(['pemilihscollection' => $pemilihs, 'pemilihdapilcollection' => $pemilihdapilcollection]);
}




// Searching pilkab Berdasarkan jumlah Suara Bobot
public function searchpemilihbobot(Request $request)
{
    $id_provinsi = $request->id_provinsi;
    $id_kabupaten = $request->id_kabupaten;
    $id_kecamatan = $request->id_kecamatan;
    $id_desa      = $request->id_desa;
    $id_dapil     = $request->id_kandidat;
    
    // Pemilihs Untuk tampilkan di tabel  ====== pemilihdapil tampilkan di grafik dan samping
    
    if($id_desa != '0'){
        $pemilihs = DB::table('pemilihs')
            ->join('provinces', 'pemilihs.id_provinsi', '=', 'provinces.id')
            ->join('regencies', 'pemilihs.id_kabupaten', '=', 'regencies.id')
            ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
            ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
            ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
            ->join('villages', 'pemilihs.id_desa', '=', 'villages.id')
            ->join('timpenggunas', 'pemilihs.id_timpengguna', '=', 'timpenggunas.id') // Added join to table kandidats
                 ->select('pemilihs.nama','pemilihs.kontak','pemilihs.jenispilihan','pemilihs.created_at','villages.name as namadesa',
                'districts.name as namakecamatan','regencies.name as namakabupaten','provinces.name as namaprovinsi',
                'kandidats.namakandidat',
                'timpenggunas.nama as namapengguna','pemilihs.kodetim')
            ->where('pemilihs.id_provinsi', '=', $id_provinsi)
            ->Where('pemilihs.id_kabupaten', '=', $id_kabupaten)
            ->Where('pemilihs.id_kecamatan', '=', $id_kecamatan)
            ->Where('pemilihs.id_desa', '=', $id_desa)
            ->Where('pemilihs.id_dapil', '=', $id_dapil)
            ->Where('dapils.jeniskandidat','=','pilkab')
            ->orderBy('pemilihs.jenispilihan')
            ->get();

        
        $pemilihdapilbobot = \DB::table('pemilihs')
        ->select('pemilihs.jenispilihan as namakecamatan', \DB::raw('count(*) as jumlah_pemilih'))
        ->where('pemilihs.id_provinsi', '=', $id_provinsi)
        ->where('pemilihs.id_kabupaten', '=', $id_kabupaten)
        ->where('pemilihs.id_kecamatan', '=', $id_kecamatan)
        ->Where('pemilihs.id_desa', '=', $id_desa)
        ->where('pemilihs.id_dapil', '=', $id_dapil)
        ->groupBy('pemilihs.jenispilihan')
        ->orderBy('pemilihs.jenispilihan')
        ->get();
        

            
    }elseif($id_kecamatan != '0'){
        $pemilihs = DB::table('pemilihs')
            ->join('provinces', 'pemilihs.id_provinsi', '=', 'provinces.id')
            ->join('regencies', 'pemilihs.id_kabupaten', '=', 'regencies.id')
            ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
            ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
            ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
            ->join('villages', 'pemilihs.id_desa', '=', 'villages.id')
            ->join('timpenggunas', 'pemilihs.id_timpengguna', '=', 'timpenggunas.id') // Added join to table kandidats
                 ->select('pemilihs.nama','pemilihs.kontak','pemilihs.jenispilihan','pemilihs.created_at','villages.name as namadesa',
                'districts.name as namakecamatan','regencies.name as namakabupaten','provinces.name as namaprovinsi',
                'kandidats.namakandidat',
                'timpenggunas.nama as namapengguna','pemilihs.kodetim')
            ->where('pemilihs.id_provinsi', '=', $id_provinsi)
            ->Where('pemilihs.id_kabupaten', '=', $id_kabupaten)
            ->Where('pemilihs.id_kecamatan', '=', $id_kecamatan)
            ->Where('pemilihs.id_dapil', '=', $id_dapil)
            ->Where('dapils.jeniskandidat','=','pilkab')
            ->orderBy('pemilihs.jenispilihan')
            ->get();

        
        $pemilihdapilbobot = \DB::table('pemilihs')
        ->select('pemilihs.jenispilihan as namakecamatan', \DB::raw('count(*) as jumlah_pemilih'))
        ->where('pemilihs.id_provinsi', '=', $id_provinsi)
        ->where('pemilihs.id_kabupaten', '=', $id_kabupaten)
        ->where('pemilihs.id_kecamatan', '=', $id_kecamatan)
        ->where('pemilihs.id_dapil', '=', $id_dapil)
        ->groupBy('pemilihs.jenispilihan')
        ->orderBy('pemilihs.jenispilihan')
        ->get();
        

            
    }else if ($id_kabupaten != '0'){
        $pemilihs = DB::table('pemilihs')
            ->join('provinces', 'pemilihs.id_provinsi', '=', 'provinces.id')
            ->join('regencies', 'pemilihs.id_kabupaten', '=', 'regencies.id')
            ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
            ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
            ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
            ->join('villages', 'pemilihs.id_desa', '=', 'villages.id')
            ->join('timpenggunas', 'pemilihs.id_timpengguna', '=', 'timpenggunas.id') // Added join to table kandidats
                ->select('pemilihs.nama','pemilihs.kontak','pemilihs.jenispilihan','pemilihs.created_at','villages.name as namadesa',
                'districts.name as namakecamatan','regencies.name as namakabupaten','provinces.name as namaprovinsi',
                'kandidats.namakandidat',
                'timpenggunas.nama as namapengguna','pemilihs.kodetim')
            ->where('pemilihs.id_provinsi', '=', $id_provinsi)
            ->Where('pemilihs.id_kabupaten', '=', $id_kabupaten)
            ->Where('pemilihs.id_dapil', '=', $id_dapil)
            ->Where('dapils.jeniskandidat','=','pilkab')
            ->orderBy('pemilihs.jenispilihan')
            ->get();
            
            
        $pemilihdapilbobot = \DB::table('pemilihs')
        ->select('pemilihs.jenispilihan as namakecamatan', \DB::raw('count(*) as jumlah_pemilih'))
        ->where('pemilihs.id_provinsi', '=', $id_provinsi)
        ->where('pemilihs.id_kabupaten', '=', $id_kabupaten)
        ->where('pemilihs.id_dapil', '=', $id_dapil)
        ->groupBy('pemilihs.jenispilihan')
        ->orderBy('pemilihs.jenispilihan')
        ->get();
    }else if ($id_provinsi != null){
        $pemilihs = DB::table('pemilihs')
            ->join('provinces', 'pemilihs.id_provinsi', '=', 'provinces.id')
            ->join('regencies', 'pemilihs.id_kabupaten', '=', 'regencies.id')
            ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
            ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
            ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
            ->join('villages', 'pemilihs.id_desa', '=', 'villages.id')
            ->join('timpenggunas', 'pemilihs.id_timpengguna', '=', 'timpenggunas.id') // Added join to table kandidats
                ->select('pemilihs.nama','pemilihs.kontak','pemilihs.jenispilihan','pemilihs.created_at','villages.name as namadesa',
                'districts.name as namakecamatan','regencies.name as namakabupaten','provinces.name as namaprovinsi',
                'kandidats.namakandidat',
                'timpenggunas.nama as namapengguna','pemilihs.kodetim')
            ->where('pemilihs.id_provinsi', '=', $id_provinsi)
            ->Where('pemilihs.id_dapil', '=', $id_dapil)
            ->Where('dapils.jeniskandidat','=','pilkab')->get();
            
            
        $pemilihdapilbobot = \DB::table('pemilihs')
        ->select('pemilihs.jenispilihan as namakecamatan', \DB::raw('count(*) as jumlah_pemilih'))
        ->where('pemilihs.id_provinsi', '=', $id_provinsi)
        ->where('pemilihs.id_dapil', '=', $id_dapil)
        ->groupBy('pemilihs.jenispilihan')
        ->orderBy('pemilihs.jenispilihan')
            ->get();
    }
        

    return response()->json(['pemilihsbobot' => $pemilihs, 'pemilihdapilbobot' => $pemilihdapilbobot]);
}

    public function pemilihpilkab()
    {
        $toptitle = "Data Pemilih Pilkab";
        $header = false;

        $provinsi = Provinces::select('id','name as namaprovinsi')->get();

        $primary = "btn-success";
        $success = "btn-primary";

        // Default menampilkan Grafik
        if(session('berhasil_login_operator', false)){

            $pemilihdapil = \DB::table('pemilihs')
            ->select('regencies.name as namakecamatan', \DB::raw('count(*) as jumlah_pemilih'))
            ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
            ->join('regencies', 'pemilihs.id_kabupaten', '=', 'regencies.id')
            ->where('dapils.jeniskandidat', '=', 'pilkab')
            ->groupBy('pemilihs.id_kabupaten', 'regencies.name')
            ->get();

             // ini data dalam tabel pemilihs default saat tampilkan halaman
            $pemilihs = DB::table('pemilihs')
            ->join('villages', 'pemilihs.id_desa', '=', 'villages.id')
            ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
            ->join('regencies', 'pemilihs.id_kabupaten', '=', 'regencies.id')
            ->join('provinces', 'regencies.province_id', '=', 'provinces.id')
            ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
            ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
            ->join('timpenggunas', 'pemilihs.id_timpengguna', '=', 'timpenggunas.id') // Added join to table kandidats
            ->select('pemilihs.nama','pemilihs.kontak','pemilihs.jenispilihan','pemilihs.created_at','villages.name as namadesa',
                'districts.name as namakecamatan','regencies.name as namakabupaten','provinces.name as namaprovinsi',
                'kandidats.namakandidat',
                'timpenggunas.nama as namapengguna','pemilihs.kodetim')
            ->Where('dapils.jeniskandidat','=', 'pilkab')->get();


            $dapils = DB::table('dapils')
                ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
                ->select('kandidats.namakandidat','dapils.id')
                ->where('dapils.jeniskandidat', 'pilkab')->get();


            
            $pemilihdapilbobot = \DB::table('pemilihs')
            ->select('districts.name as namakecamatan', \DB::raw('count(*) as jumlah_pemilih'))
            ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
            ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
            ->where('dapils.jeniskandidat', '=', 'pilkab')
            ->groupBy('pemilihs.id_kecamatan', 'districts.name')
            ->get();
            $wilayah = "";
            
        
        }elseif(session('berhasil_login_admins', false)){

            if(session('jeniskandidat') == 'pilkab'){

                $pemilihdapil = \DB::table('pemilihs')
                ->select('regencies.name as namakecamatan', \DB::raw('count(*) as jumlah_pemilih'))
                ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
                ->join('regencies', 'pemilihs.id_kabupaten', '=', 'regencies.id')
                ->where('dapils.jeniskandidat', '=', 'pilkab')
                ->where('dapils.id', session('id_dapil'))
                ->where('pemilihs.jenis_suara', 3)
                ->groupBy('pemilihs.id_kabupaten', 'regencies.name')
                ->get();

                $wilayah = DB::table('districts')
                    ->select('id', 'name as namakecamatan')
                    ->where('regency_id', session('id_kabupaten'))->get();


                $pemilihdapilbobot = \DB::table('pemilihs')
                ->select('districts.name as namakecamatan', \DB::raw('count(*) as jumlah_pemilih'))
                ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
                ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
                ->where('dapils.jeniskandidat', '=', 'pilkab')
                ->where('dapils.id', session('id_dapil'))
                ->where('pemilihs.jenis_suara', 3)
                ->groupBy('pemilihs.id_kecamatan', 'districts.name')
                ->get();


            }elseif(session('jeniskandidat') == 'pilgub'){
                $pemilihdapil = \DB::table('pemilihs')
                ->select('regencies.name as namakecamatan', \DB::raw('count(*) as jumlah_pemilih'))
                ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
                ->join('regencies', 'pemilihs.id_kabupaten', '=', 'regencies.id')
                ->where('dapils.id', session('id_dapil'))
                ->where('pemilihs.jenis_suara', 3)
                ->groupBy('pemilihs.id_kabupaten', 'regencies.name')
                ->get();

                $wilayah = DB::table('dapils')
                ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
                ->join('provinces', 'dapils.id_provinsi', '=', 'provinces.id')
                ->select('kandidats.namakandidat','dapils.id', 'provinces.name as namakecamatan')
                ->where('dapils.jeniskandidat', session('jeniskandidat'))->get();


                $pemilihdapilbobot = \DB::table('pemilihs')
                ->select('districts.name as namakecamatan', \DB::raw('count(*) as jumlah_pemilih'))
                ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
                ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
                ->where('dapils.jeniskandidat', '=', 'pilkab')
                ->where('dapils.id', session('id_dapil'))
                ->where('pemilihs.jenis_suara', 3)
                ->groupBy('pemilihs.id_kecamatan', 'districts.name')
                ->get();
            }

             // ini data dalam tabel pemilihs default saat tampilkan halaman
            $pemilihs = DB::table('pemilihs')
            ->join('villages', 'pemilihs.id_desa', '=', 'villages.id')
            ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
            ->join('regencies', 'pemilihs.id_kabupaten', '=', 'regencies.id')
            ->join('provinces', 'regencies.province_id', '=', 'provinces.id')
            ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
            ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
            ->join('timpenggunas', 'pemilihs.id_timpengguna', '=', 'timpenggunas.id') // Added join to table kandidats
            ->select('pemilihs.nama','pemilihs.kontak','pemilihs.jenispilihan','pemilihs.created_at','villages.name as namadesa',
                'districts.name as namakecamatan','regencies.name as namakabupaten','provinces.name as namaprovinsi',
                'kandidats.namakandidat',
                'timpenggunas.nama as namapengguna')
            ->Where('dapils.jeniskandidat','=', session('jeniskandidat'))
            ->where('pemilihs.jenis_suara', 3)
            ->where('dapils.id', session('id_dapil'))->get();


            $dapils = DB::table('dapils')
            ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
            ->select('kandidats.namakandidat','dapils.id')
            ->where('dapils.id', session('id_dapil'))->get();

        }

        $regencies = Regencies::where('id', session('id_kabupaten'))->first();

        $province_id = $regencies ? $regencies->province_id : null;

        return view('master.pemilih', compact('header','toptitle','pemilihs','provinsi','dapils','primary','success','pemilihdapil','pemilihdapilbobot','wilayah','province_id'));
        //return view('landingpage.layout');
    }
 //ipul
    public function pemilihpilgub()
    {
        $toptitle = "Data Pemilih Pilgub";
        $header = false;

        $provinsi = Provinces::select('id','name as namaprovinsi')->get();
        $dapils = DB::table('dapils')
            ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
            ->select('kandidats.namakandidat','dapils.id')
            ->where('dapils.jeniskandidat', 'pilgub')->get();


        // ini data dalam tabel pemilihs
        $pemilihs = DB::table('pemilihs')
            ->join('villages', 'pemilihs.id_desa', '=', 'villages.id')
            ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
            ->join('regencies', 'pemilihs.id_kabupaten', '=', 'regencies.id')
            ->join('provinces', 'regencies.province_id', '=', 'provinces.id')
            ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
            ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
            ->join('timpenggunas', 'pemilihs.id_timpengguna', '=', 'timpenggunas.id') // Added join to table kandidats
            ->select('pemilihs.nama','pemilihs.kontak','pemilihs.id_kandidat','pemilihs.jenispilihan','pemilihs.rt','pemilihs.rw','pemilihs.created_at','villages.name as namadesa',
                'districts.name as namakecamatan','regencies.name as namakabupaten','provinces.name as namaprovinsi',
                'kandidats.namakandidat',
                'timpenggunas.nama as namapengguna','pemilihs.kodetim')
            ->Where('dapils.jeniskandidat','=','pilgub')->get();

        $primary = "btn-success";
        $success = "btn-primary";

        // Default menampilkan Grafik
        if(session('berhasil_login_operator', false)){

            $pemilihdapil = \DB::table('pemilihs')
            ->select('regencies.name as namakecamatan', \DB::raw('count(*) as jumlah_pemilih'))
            ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
            ->join('regencies', 'pemilihs.id_kabupaten', '=', 'regencies.id')
            ->where('dapils.jeniskandidat', '=', 'pilgub')
            ->where('dapils.id', '5')
            ->groupBy('pemilihs.id_kabupaten', 'regencies.name')
            ->get();

            
        
        }elseif(session('berhasil_login_admins', false)){

            if(session('jeniskandidat') == 'pilkab'){
                $pemilihdapil = \DB::table('pemilihs')
                    ->select('districts.name', \DB::raw('count(*) as jumlah_pemilih'))
                    ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
                    ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
                    ->where('dapils.id', session('id_dapil'))
                    ->groupBy('pemilihs.id_kecamatan', 'districts.name')
                    ->get();
            }elseif(session('jeniskandidat') == 'pilgub'){
                $pemilihdapil = \DB::table('pemilihs')
                    ->select('regencies.name as namakecamatan', \DB::raw('count(*) as jumlah_pemilih'))
                    ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
                    ->join('regencies', 'pemilihs.id_kabupaten', '=', 'regencies.id')
                    ->where('dapils.id', session('id_dapil'))
                    ->groupBy('pemilihs.id_kabupaten', 'regencies.name')
                    ->get();
            }

        }

        
        $pemilihdapilbobot = \DB::table('pemilihs')
            ->select('districts.name as namakecamatan', \DB::raw('count(*) as jumlah_pemilih'))
            ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
            ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
            ->where('dapils.jeniskandidat', '=', 'pilgub')
            ->groupBy('pemilihs.id_kecamatan', 'districts.name')
            ->get();

        $pemilihdapilcollection = \DB::table('pemilihs')
        ->select('districts.name as namakecamatan', \DB::raw('count(*) as jumlah_pemilih'))
        ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
        ->join('districts', 'pemilihs.id_kecamatan', '=', 'districts.id')
        ->where('dapils.jeniskandidat', '=', 'pilgub')
        ->where('dapils.id', '=', '11')
        ->groupBy('pemilihs.id_kecamatan', 'districts.name')
        ->get();

        return view('master.pemilihgub', compact('header','toptitle','pemilihs','provinsi','dapils',
                    'primary','success','pemilihdapil','pemilihdapilbobot','pemilihdapilcollection'));
        //return view('landingpage.layout');
    }

    public function tambah()
    {
        //$products = Product::latest()->paginate(5);
        //$master = master::latest()->paginate(5);
        //$kegiatan = Kegiatan::latest()->paginate(5);
        $toptitle = "Tambah Data master";
        $header = false;
        return view('master.tambah', compact('header','toptitle'));
        //return view('landingpage.layout');
    }


    public function simpan(Request $request)
    {
        $this->validate($request,[
            'judul' => 'required',
            'nama' => 'required',
            'programstudi' => 'required',
            'angkatan' => 'nullable',
            'jabatan' => 'nullable',
            'pekerjaan' => 'nullable',
            'detail' => 'required',
            'foto' => 'required|image|mimes:jpeg,jpg,png'
        ]);

        //upload foto
        $foto = $request->foto;
        $namafile = time()."_".$foto->getClientOriginalName();
        $tujuan_upload = 'images/master';
        $foto->move($tujuan_upload,$namafile);

        $judulnya = $request->judul;
        //SlugService::createSlug(Post::class, 'slug', $post->title);

        masters::create([
            'judul' => $request->judul,
            'nama' => $request->nama,
            'programstudi' => $request->programstudi,
            'angkatan' => $request->angkatan,
            'jabatan' => $request->jabatan,
            'pekerjaan' => $request->pekerjaan,
            'detail' => $request->detail,
            'foto' => $namafile
        ]);

        if($foto){
            return redirect('admin/master/home')->with('success','Data berhasil disimpan');
        }
        else{
            return redirect()->back()->withInput()->withErrors($request->all())->with('error','Data gagal disimpan, cek kembali form anda');
        }
    }


    public function ubah($id)
    {
        $masters = masters::find($id);
        $toptitle = "Ubah Data master";
        return view('master.ubah', ['dataubah' => $masters,'toptitle' => $toptitle]);
    }


    public function update(Request $request)
    {
        $this->validate($request,[
            'judul' => 'required',
            'nama' => 'required',
            'programstudi' => 'required',
            'angkatan' => 'nullable',
            'jabatan' => 'nullable',
            'pekerjaan' => 'nullable',
            'detail' => 'nullable',
            'foto' => 'image|mimes:jpeg,jpg,png'
        ]);

        $id = $request->id;
        $masters = masters::find($id);
        $foto = $request->foto;
        if($foto){
            $namafile = time()."_".$foto->getClientOriginalName();
            $tujuan_upload = 'images/master';
            $foto->move($tujuan_upload,$namafile);
        }
        else{
            $namafile = $masters->foto;
        }

        masters::whereId($id)->update([
            'judul' => $request->judul,
            'nama' => $request->nama,
            'programstudi' => $request->programstudi,
            'angkatan' => $request->angkatan,
            'jabatan' => $request->jabatan,
            'pekerjaan' => $request->pekerjaan,
            'detail' => $request->detail,
            'foto' => $namafile
        ]);

        return redirect('admin/master/home')->with('success','Data berhasil diubah');
    }


    public function hapus($id)
    {
        $masters = masters::find($id);
        $namafile = $masters->foto;
        File::delete('/images/master/'.$namafile);
        if($masters->delete()){
            return redirect('admin/master/home')->with('success','Data berhasil dihapus');
        }
        else{
            return redirect('admin/master/home')->with('error','Data gagal dihapus');
        }
    }
}
