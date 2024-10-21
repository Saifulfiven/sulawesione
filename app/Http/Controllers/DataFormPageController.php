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
//use Illuminate\Support\Facades\Auth;
//perbaikan
use Illuminate\Support\Facades\DB; // Import DB class
use Session;

class DataFormPageController extends Controller
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
        return view('dataform.index', compact('header','toptitle','provinsis','provinsi'));
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
        return view('dataform.component-kabupaten', compact('kabupaten','header','toptitle','provinsi'));
    }


    // Search Kabupaten
    public function searchkabupaten(Request $request)
    {
        $kabupatens = Regencies::select('id','name as namakabupaten')
                                ->where('province_id',$request->id_provinsi)->get();

        return 'kucing';
        return response()->json($kabupatens);
    }

    // Search Kecamatan
    public function searchkecamatan(Request $request)
    {
        $kecamatan = Districts::select('id','name')
                                ->where('regency_id',$request->id_kabupaten)->get();
        return response()->json($kecamatan);
    }


// + Tim Inti Pilkab
    public function tambahpendukung()
    {
        $toptitle = "Tambah Pendukung";
        $header = false;

        $id_timinti = session('id_timpengguna');

        $datadapils = DB::table('timpenggunas')
        ->join('dapils', 'timpenggunas.id_dapil', '=', 'dapils.id')
        ->join('regencies', 'timpenggunas.id_kabupaten', '=', 'regencies.id')
        ->join('provinces', 'timpenggunas.id_provinsi', '=', 'provinces.id')
            ->select('dapils.id as id_dapil','provinces.id as id_provinsi','regencies.id as id_kabupaten','regencies.name as namakabupaten')
            ->where('timpenggunas.id', $id_timinti)
            ->first();
        //$jeniskandidat = "DATA TIM PENDUKUNG PEMENANGAN CALON $datadapils->namakabupaten";

            // $provinsi = Provinces::select('id','name as namaprovinsi')->get();
            // $kecamatans = Districts::all();

            $tampilkankec = DB::table('regencies')
            ->join('timpenggunas', 'timpenggunas.id_kabupaten', '=', 'regencies.id')
            ->join('districts', 'regencies.id', '=', 'districts.regency_id')
            ->select('districts.id','districts.name as namakecamatan')
            ->where('timpenggunas.id', $id_timinti)
            ->get();

            $namaKabupaten = $datadapils->namakabupaten;
            if($datadapils->namakabupaten == "KOTA GORONTALO"){

                $judultim = "Tim Pendukung Calon Walikota";
            }else{
                $judultim = "Tim Pendukung Calon Bupati ";
            }



            $provinsi = Provinces::where('status', 1)->get();
        return view('dataform.pengguna-pilkab-register', compact('header','toptitle',
                    'datadapils','tampilkankec','judultim','namaKabupaten','judultim','provinsi'));
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

        if(session('berhasil_login')){
            if ($namaKabupaten == "kota gorontalo"){
                $judultim = "Tim Pendukung  Calon Walikota ";
            }else{
                $judultim = "Tim Pendukung  Calon Walikota ";
            }
        }else{
             if ($namaKabupaten == "kota gorontalo"){
                 $judultim = "Tim Pemenangan  Calon Walikota ";
             }else{
                 $judultim = "Tim Pemenangan  Calon Walikota ";
             }

        }

        $toptitle = $judultim;

        $provinsi = Provinces::where('status', 1)->get();
        return view('dataform.pengguna-pilkab-register', compact('data','header','toptitle',
                    'datadapils','jeniskandidat','kecamatans','tampilkankec','namaKabupaten','judultim','provinsi'));
    }

    public function showFormpilgub($value)
    {
        $toptitle = "Calon Anggota Tim Inti dari Prov. $value";
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
        if(session('berhasil_login')){
            $judultim = "Tim Pendukung Pemenangan Calon Gubernur $value";
        }else{
            $judultim = "Tim Inti Pemenangan Calon Gubernur $value";
        }


        $provinsi = Provinces::where('status', 1)->get();

        return view('dataform.pengguna-pilgub-register',
            compact('data','header','toptitle','jeniskandidat','kecamatans',
            'datadapils','tampilkankab','judultim','provinsi'));
    }


    public function showFormpilgubpendukung()
    {

        $id_timinti = session('id_timpengguna');


        $datadapils = DB::table('timpenggunas')
            ->join('provinces', 'timpenggunas.id_provinsi', '=', 'provinces.id')
            ->join('regencies', 'timpenggunas.id_kabupaten', '=', 'regencies.id')
            ->select('provinces.id as id_provinsi','provinces.name as namaprovinsi',
              'regencies.id as id_kabupaten','regencies.name as namakabupaten','timpenggunas.id_dapil')
            ->where('timpenggunas.id', $id_timinti)
            ->first();
            // $jeniskandidat = "DATA TIM PENDUKUNG PEMENANGAN CALON $datadapils->namakabupaten";

            $tampilkankec = DB::table('regencies')
            ->join('timpenggunas', 'timpenggunas.id_kabupaten', '=', 'regencies.id')
            ->join('districts', 'regencies.id', '=', 'districts.regency_id')
            ->select('districts.id','districts.name as namakecamatan')
            ->where('timpenggunas.id', $id_timinti)
            ->get();


        $provinsi = Provinces::select('id','name as namaprovinsi')->get();
        $kecamatans = Districts::all();


        $toptitle = "Calon Anggota Tim Inti dari Prov";
        $header = false;
        $jeniskandidat = "PILGUB";
        $judultim = "Tim Pendukung Pemenangan Calon Gubernur Provinsi ".$datadapils->namaprovinsi.", ".$datadapils->namakabupaten;


        $provinsi = Provinces::where('status', 1)->get();
        return view('dataform.pengguna-pilgub-register-pendukung',
            compact('header','toptitle','jeniskandidat','kecamatans','datadapils','tampilkankec','judultim','provinsi'));
    }

    public function penggunastore(Request $request)
    {

        $this->validate($request,[
            'id_dapil'   => 'required',
            'nama'       => 'required',
            'username'   => 'nullable',
            'password'   => 'nullable',
            'ktp'        => 'nullable',
            'provinsi'   => 'nullable',
            'kabupaten'  => 'nullable',
            'kecamatan'  => 'nullable',
            'desa'       => 'nullable',
            'kontak'     => 'nullable',
            'foto'       => 'nullable|image|mimes:jpeg,jpg,png'
        ]);

           //upload gambar
           $namafile = "pengguna.png";
           if($request->jenistim == "A"){
            $foto = $request->foto;
            $namafile = time()."_".$foto->getClientOriginalName();
            $tujuan_upload = 'images/timpengguna';
            $foto->move($tujuan_upload,$namafile);
            }else if($request->jenistim == "B"){
                $foto = $request->foto;
                $namafile = time()."_".$foto->getClientOriginalName();
                $tujuan_upload = 'images/timpengguna';
                $foto->move($tujuan_upload,$namafile);
            }

           if($namafile != ""){
                $namafile = $namafile;
           }else{
                $namafile = "pengguna.png";
           }

        // insert data ke tabel kedua
        if(session('berhasil_login')){

            $id_timinti = session('id_timpengguna');
            $jenistim  = "B";
        }else{
            $id_timinti = "0";
            $jenistim  = "A";
        }

        $pengguna = Timpenggunas::create([
            'id_dapil'                  => $request->id_dapil,
            'id_timinti'                => $id_timinti,
            'jenistim'                  => $jenistim,
            'username'                  => $request->username,
            'password'                  => $request->password,
            'nama'                      => $request->nama,
            'ktp'                       => $request->ktp,
            'id_kecamatan'              => $request->kecamatan,
            'id_kabupaten'              => $request->kabupaten,
            'id_provinsi'               => $request->provinsi,
            'alamat'                    => $request->alamat,
            'id_desa'                   => $request->desa,
            'kontak'                    => $request->kontak,
            'jumlahpemilihrumahtangga'  => '4',
            'nomortps'                  => '01',
            'foto'                      => $namafile,
            'remember_token'            => 0,
            'latitude'                  => 'latitude',
            'longitude'                 => 'longitude',
        ]);


        if($pengguna){
            return redirect('dataform/sukses')->with('success','Data berhasil disimpan');
        }
        else{
            return redirect()->back()->withInput()->withErrors($request->all())->with('error','Data gagal disimpan, cek kembali form anda');
        }
    }

    public function sukses()
    {
        $toptitle = "Berhasil Mendaftar Sebagai TIM";
        $header = false;


        $provinsi = Provinces::where('status', 1)->get();
        return view('dataform.sukses', compact('header','toptitle','provinsi'));
    }

    public function loginuser()
    {
        $toptitle = "Login User";
        $header = false;

        $provinsi = Provinces::where('status', 1)->get();
        return view('dataform.loginuser', compact('header','toptitle','provinsi'));
    }

    public function actionlogin(Request $request)
    {
        $data = [
            'ktp' => $request->input('nomorktp'),
        ];
        $nomorktp = $request->input('nomorktp');

        // if (Auth::Attempt($data)) {
        //     return redirect('/home');
        // }
        //$request->password
        $nama = "Burdette Reichel";
        if (Auth::attempt(['ktp' => $nomorktp, 'nama' => $nama])) {
            $request->session()->regenerate();

            return redirect()->intended('home');
        }else{
            Session::flash('error', 'NIK Yang Anda Masukkan Salah');
            return redirect('/login');
        }
    }

    // public function aksilogin(Request $request)
    // {
    //     $nomorktp = $request->nomorktp;
    //     $pemilih = timintis::where('ktp', $nomorktp)->first();
    //     if ($pemilih) {
    //         Auth::login($pemilih);
    //         return redirect('/');
    //     } else {
    //         return redirect('/login')->with('error', 'Nomor KTP tidak ditemukan');
    //     }
    // }


}
