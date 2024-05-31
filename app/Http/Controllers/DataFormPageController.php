<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StepSatu;
use App\Models\StepDua;
use App\Models\StepTigas;
use App\Models\StepTigaDua;
use App\Models\timintis;
use App\Models\provinsi;
use App\Models\kecamatan;
use App\Models\Timpenggunas;
use App\Models\pemilihs;
use App\Models\Dapils;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Import DB class
use Session;

class DataFormPageController extends Controller
{
    //
    public function index()
    {
        $toptitle = "Data Form List Provinsi";
        $header = false;
        $provinsis = Provinsi::all();
        return view('dataform.index', compact('header','toptitle','provinsis'));
    }

    public function showDataKab($value)
    {
        
        $toptitle = "List Kabupaten dari Prov. $value";
        $header = false;
        $data = DB::table('provinsis')
        ->join('kabupatens', 'provinsis.id', '=', 'kabupatens.id_propinsi')
        ->join('dapils', 'kabupatens.id', '=', 'dapils.id_kabupaten')
        ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id') // Added join to table kandidats
        ->select('kabupatens.namakabupaten','kabupatens.slug','kandidats.foto')
        ->where('provinsis.slug', $value)
        ->get();

        return view('dataform.component-kabupaten', compact('data','header','toptitle'));
    }

    
    // Search Kabupaten
    public function searchkabupaten(Request $request)
    {
        $kabupatens = kabupaten::select('id','namakabupaten')
                                ->where('id_propinsi',$request->id_provinsi)->get();
        return response()->json($kabupatens);
    }

    // Search Kecamatan
    public function searchkecamatan(Request $request)
    {
        $kecamatan = kecamatan::select('id','namakecamatan')
                                ->where('id_kabupaten',$request->id_kabupaten)->get();
        return response()->json($kecamatan);
    }
    

// + Tim Inti Pilkab
    public function tambahpendukung()
    {
        $toptitle = "Tambah Pendukung";
        $header = false;
        
        $id_timinti = session('id_timpengguna');

        $datadapils = DB::table('dapils')
            ->join('kabupatens', 'dapils.id_kabupaten', '=', 'kabupatens.id')
            ->select('dapils.id','kabupatens.id as id_kabupaten','kabupatens.namakabupaten')
            ->where('timpenggunas.id', $id_timinti)
            ->first();
        $jeniskandidat = "DATA TIM PENDUKUNG PEMENANGAN CALON $datadapils->namakabupaten";
       
        
            $provinsi = provinsi::select('id','namaprovinsi')->get();
            $kecamatans = kecamatan::all();

         if(session('berhasil_login')){
            $judultim = "Tim Pendukung Pemenangan Calon Walikota $value";
        }else{
            $judultim = "Tim Inti Pemenangan Calon Walikota $value";
        }

        return view('dataform.pengguna-pilkab-register', compact('data','header','toptitle',
                    'datadapils','jeniskandidat','kecamatans','provinsi','judultim'));
    }

    public function showFormpilkab($value)
    {
        $toptitle = "List Kabupaten dari Prov. $value";
        $header = false;
        $data = $value;
        $jeniskandidat = "DATA TIM INTI PEMENANGAN CALON WALIKOTA GORONTALO";
        
        $datadapils = DB::table('dapils')
            ->join('kabupatens', 'dapils.id_kabupaten', '=', 'kabupatens.id')
            ->select('dapils.id','kabupatens.id as id_kabupaten')
            ->where('kabupatens.slug', $value)
            ->first();

        
            $provinsi = provinsi::select('id','namaprovinsi')->get();
            $kecamatans = kecamatan::all();

        // $kecamatans = DB::table('kecamatans')
        //     ->join('kabupatens', 'kecamatans.id_kabupaten', '=', 'kabupatens.id')
        //     ->select('kecamatans.namakecamatan','kecamatans.id')
        //     ->where('kabupatens.slug', $value)
        //     ->get();

         // insert data ke tabel kedua
         if(session('berhasil_login')){
            $judultim = "Tim Pendukung Pemenangan Calon Walikota $value";
        }else{
            $judultim = "Tim Inti Pemenangan Calon Walikota $value";
        }

        return view('dataform.pengguna-pilkab-register', compact('data','header','toptitle',
                    'datadapils','jeniskandidat','kecamatans','provinsi','judultim'));
    }


    public function showFormpilgub($value)
    {
        $toptitle = "List Kabupaten dari Prov. $value";
        $header = false;
        $data = $value;
        $jeniskandidat = "PILGUB";


        $datadapils = DB::table('dapils')
            ->join('provinsis', 'dapils.id_provinsi', '=', 'provinsis.id')
            ->select('dapils.id','provinsis.id as id_provinsi')
            ->where('provinsis.slug', $value)
            ->first();
        
        // foreach ($datadapils as $dapil) {
        //     $id_dapils[] = $dapil->id;
        // }

        // $data = $id_dapils;

        // $kecamatans = DB::table('kecamatans')
        //     ->join('kabupatens', 'kecamatans.id_kabupaten', '=', 'kabupatens.id')
        //     ->select('kecamatans.namakecamatan','kecamatans.id')
        //     ->where('kabupatens.slug', $value)
        //     ->get();
        
        $kecamatans = kecamatan::all();

        return view('dataform.pengguna-pilgub-register', compact('data','header','toptitle','jeniskandidat','kecamatans','datadapils'));
    }
    
    public function penggunastore(Request $request)
    {
        
        $this->validate($request,[
            'id_dapil'   => 'required',
            'nama'       => 'required',
            'email'      => 'required',
            'password'   => 'required',
            'ktp'        => 'nullable',
            'provinsi'   => 'nullable',
            'kabupaten'  => 'nullable',
            'kecamatan'  => 'nullable',
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
            'email'                     => $request->email,
            'password'                  => $request->password,
            'nama'                      => $request->nama,
            'ktp'                       => $request->ktp,
            'id_kecamatan'              => $request->kecamatan,
            'id_kabupaten'              => $request->kabupaten,
            'id_provinsi'               => $request->provinsi,
            'alamat'                    => $request->alamat,
            'id_desa'                   => $request->id_desa,
            'kontak'                    => $request->kontak,
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
        
        return view('dataform.sukses', compact('header','toptitle'));
    }

    public function loginuser()
    {
        $toptitle = "Login User";
        $header = false;
        return view('dataform.loginuser', compact('header','toptitle'));
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
