<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\StepSatu;
use App\Models\StepDua;
use App\Models\StepTigas;
use App\Models\StepTigaDua;
use App\Models\timintis;
use App\Models\Provinces;
use App\Models\Regencies;
use App\Models\Districts;
use App\Models\Villages;
use App\Models\Timpenggunas;
use App\Models\pemilihs;
use App\Models\Dapils;
use App\Models\Kandidatwilayahs;

//use Illuminate\Support\Facades\Auth;
//perbaikan
use Illuminate\Support\Facades\DB; // Import DB class
use Session;
class PendukungController extends Controller
{
    //
    public function index($id_prov)
    {
        $toptitle = "Data Form List Provinsi";
        $header = false;
        //$provinsis = Provinces::where('aktif', '=', '1')->get();

        $provinsis = DB::table('dapils')
        ->join('kandidats','dapils.id_kandidat', '=' ,'kandidats.id')
        ->join('provinces','dapils.id_provinsi', '=','provinces.id')
        ->where('dapils.jeniskandidat','=','pilgub')
        ->where('provinces.slug', '=', $id_prov)
        
        ->select('kandidats.namakandidat','kandidats.foto','provinces.name as namaprovinsi',
                'provinces.slug')->get();

        
        //return $provinsis;

        $provinsi = Provinces::where('status', 1)->get();
        return view('pendukung.index', compact('header','toptitle','provinsis','provinsi'));
    }

    public function showFormpilgub($value)
    {
        $toptitle = "Pendukung dari Prov. $value";
        $header = false;
        $data = $value;
        $jeniskandidat = "PILGUB";


        $datadapils = DB::table('dapils')
            ->join('provinces', 'dapils.id_provinsi', '=', 'provinces.id')
            ->join('regencies', 'provinces.id', '=', 'regencies.province_id')
            ->select('dapils.id as id_dapil','provinces.id as id_provinsi','provinces.name as namaprovinsi')
            ->where('provinces.slug', $value)
            ->first();

            $tampilkankab = DB::table('provinces')
            ->join('regencies', 'provinces.id', '=', 'regencies.province_id')
            ->select('regencies.id','regencies.name as namakabupaten')
            ->where('provinces.slug', $value)
            ->get();

        
        $tampilkankandidat = DB::table('dapils')
            ->join('kandidatwilayahs', 'dapils.id', '=', 'kandidatwilayahs.id_dapil')
            ->select('kandidatwilayahs.id','kandidatwilayahs.namakandidat')
            ->where('dapils.id', $datadapils->id_dapil)
            ->get();
        // foreach ($datadapils as $dapil) {
        //     $id_dapils[] = $dapil->id;
        // }

        // $data = $id_dapils;

        // $kecamatans = DB::table('kecamatans')
        //     ->join('kabupatens', 'kecamatans.id_kabupaten', '=', 'kabupatens.id')
        //     ->select('kecamatans.namakecamatan','kecamatans.id')
        //     ->where('kabupatens.slug', $value)
        //     ->get();

        $provinsi = Provinces::select('id','name as namaprovinsi')->get();
        $kecamatans = Districts::all();

        // insert data ke tabel kedua
        $judultim = "Tim Pendukung Pemenangan Calon Gubernur $value";
        


        $provinsi = Provinces::where('status', 1)->get();



        return view('pendukung.pengguna-pilgub-register',
            compact('data','header','toptitle','jeniskandidat','kecamatans',
            'datadapils','tampilkankab','judultim','provinsi', 'tampilkankandidat'));
    }


    public function penggunastore(Request $request)
    {

        $this->validate($request,[
            'id_dapil'   => 'required',
            'nama'       => 'required',
            'ktp'        => 'nullable',
            'provinsi'   => 'nullable',
            'kabupaten'  => 'required',
            'kecamatan'  => 'required',
            'desa'       => 'required',
            'kontak'     => 'nullable',
        ]);

        $id_timpengguna = session('id_timpengguna') ? session('id_timpengguna') : 0;

        $pemilihs = Pemilihs::create([
            'id_dapil'                  => $request->id_dapil,
            'id_timpengguna'            => $id_timpengguna,
            'nama'                      => $request->nama,
            'ktp'                       => $request->ktp,
            'id_desa'                   => $request->desa,
            'id_kecamatan'              => $request->kecamatan,
            'id_kabupaten'              => $request->kabupaten,
            'id_provinsi'               => $request->provinsi,
            'rt'                        => $request->rt,
            'rw'                        => $request->rw,
            'jenis_suara'               => 2,
            'kontak'                    => $request->kontak,
            'alamat'                    => $request->alamat,
            'jenispilihan'              => 5,
            'id_kandidat'               => $request->id_kandidat,
            'kodetim'                   => $request->kodetim,
        ]);


        if($pemilihs){
            return redirect('dataform/sukses')->with('success','Data berhasil disimpan');
        }
        else{
            return redirect()->back()->withInput()->withErrors($request->all())->with('error','Data gagal disimpan, cek kembali form anda');
        }
    }


    public function berhasil()
    {
        $toptitle = "Selamat Anda Berhasil Terdaftar Sebagai Pendukung";
        $header = false;


        $provinsi = Provinces::where('status', 1)->get();
        return view('pendukung.berhasil', compact('header','toptitle','provinsi'));
    }


    public function showDataKab($namakabupaten)
    {

        $toptitle = "List Kabupaten";
        $header = false;
        $kabupaten = DB::table('regencies')
        ->join('dapils', 'regencies.id', '=', 'dapils.id_kabupaten')
        ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id') // Added join to table kandidats
        ->where('regencies.slug', '=', $namakabupaten)
        ->select('regencies.name as namakabupaten','regencies.slug','kandidats.foto')
        ->first();


        $provinsi = Provinces::where('status', 1)->get();
        return view('pendukung.component-kabupaten', compact('kabupaten','header','toptitle','provinsi'));
    }


    public function showFormpilkab($value)
    {
        $header = false;
        $data = $value;
        if ($value == "kota-gorontalo"){
            $jeniskandidat = "DATA TIM INTI PEMENANGAN CALON WALIKOTA Gorontalo";
        }else{
            $jeniskandidat = "DATA TIM INTI PEMENANGAN CALON WALIKOTA $value";
        }

        $datadapils = DB::table('dapils')
            ->join('regencies', 'dapils.id_kabupaten', '=', 'regencies.id')
            ->select('dapils.id as id_dapil','regencies.id as id_kabupaten','regencies.province_id as id_provinsi')
            ->where('regencies.slug', $value)
            ->first();


            $tampilkankec = DB::table('regencies')
            ->join('districts', 'regencies.id', '=', 'districts.regency_id')
            ->select('districts.id','districts.name as namakecamatan')
            ->where('regencies.slug', $value)
            ->get();


            $provinsi = Provinces::select('id','name as namaprovinsi')->get();
            $kecamatans = Districts::all();

        // $kecamatans = DB::table('kecamatans')
        //     ->join('kabupatens', 'kecamatans.id_kabupaten', '=', 'kabupatens.id')
        //     ->select('kecamatans.namakecamatan','kecamatans.id')
        //     ->where('kabupatens.slug', $value)
        //     ->get();

        $namaKabupaten = Regencies::select('name')->where('slug', $value)->first();
        $namaKabupaten = $namaKabupaten->name;

             if ($namaKabupaten == "kota gorontalo"){
                 $judultim = "Pendukung  Calon Walikota ";
             }else{
                 $judultim = "Pendukung  Calon Walikota ";
             }

        $toptitle = $judultim;


        $tampilkankandidat = DB::table('dapils')
            ->join('kandidatwilayahs', 'dapils.id', '=', 'kandidatwilayahs.id_dapil')
            ->select('kandidatwilayahs.id','kandidatwilayahs.namakandidat')
            ->where('dapils.id', $datadapils->id_dapil)
            ->get();

        $provinsi = Provinces::where('status', 1)->get();
        return view('pendukung.pengguna-pilkab-register', compact('data','header','toptitle',
                    'datadapils','jeniskandidat','kecamatans','tampilkankec','namaKabupaten','judultim','provinsi','tampilkankandidat'));
    }


}
