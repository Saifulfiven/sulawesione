<?php

namespace App\Http\Controllers;

use App\Models\Provinces;
use App\Models\Regencies;
use Illuminate\Http\Request;
use App\Models\Dapils;
use App\Models\kandidat;
use Illuminate\Support\Facades\DB; // Import DB class

class DapilPageController extends Controller
{
    //Dashboard
    public function index()
    {
        //$products = Product::latest()->paginate(5);
        //$Dapil = Dapils::latest()->paginate(5);
        //$kegiatan = Kegiatan::latest()->paginate(5);
        $toptitle = "Dashboard - Dapil";
        $header = false;
        //$Dapils = Dapils::latest()->paginate(5);
        $Dapilkab = DB::table('dapils')
                        ->join('regencies','dapils.id_kabupaten', '=' ,'regencies.id')
                        ->join('kandidats','dapils.id_kandidat', '=' ,'kandidats.id')
                        ->where('dapils.jeniskandidat','=','pilkab')
                        ->orderBy('regencies.province_id')
                      //->joiprovince_ids','Dapils.province_id', '='province_ids.id')
                      ->select('kandidats.namakandidat','regencies.name as namakabupaten',
                                'dapils.created_at','dapils.updated_at','dapils.id')->get();



        $Dapilprov = DB::table('dapils')
        ->join('kandidats','dapils.id_kandidat', '=' ,'kandidats.id')
        ->join('provinces','dapils.id_provinsi', '=','provinces.id')
        ->where('dapils.jeniskandidat','=','pilgub')
        ->select('kandidats.namakandidat','provinces.name as namaprovinsi',
                'dapils.created_at','dapils.updated_at','dapils.id')->get();
        return view('dapil.tabel', compact('header','toptitle','Dapilkab','Dapilprov'));
        //return view('landingpage.layout');
    }

    public function tambah()
    {
        $toptitle   = "Tambah Data Dapil";
        $header     = false;
        $provinsi   = Provinces::get();
        $kandidat   = Kandidat::get();
        $kabupaten  = Regencies::orderBy('province_id')->get();
        //$kandidat = kandidat::get();
        return view('dapil.tambah', compact('header','toptitle','kandidat','provinsi','kabupaten'));
        //return view('landingpage.layout');
    }


    public function simpan(Request $request)
    {
        $this->validate($request,[
            'id_kandidat'   => 'required',
            'id_kabupaten'  => 'nullable',
            'id_provinsi'   => 'nullable',
            'jeniskandidat' => 'nullable',
            'username'      => 'nullable',
            'password'      => 'nullable',

        ]);

        $namaDapilnya = $request->namaDapil;
        //SlugService::createSlug(Post::class, 'slug', $post->title);

        $jenis = $request->jeniskandidat;
        if($jenis == "pilgub"){
            $prov = $request->id_provinsi;
            $kab  = 0;
        }else{
            $kab = $request->id_kabupaten;
            $prov = 0;
        }
        $kab = Dapils::create([
            'id_kandidat'   => $request->id_kandidat,
            'id_kabupaten'  => $kab,
            'id_provinsi'   => $prov,
            'jeniskandidat' => $request->jeniskandidat,
            'username'      => $request->username,
            'password'      => bcrypt($request->password),
        ]);

        if($kab){
            return redirect('admin/dapil')->with('success','Data berhasil disimpan');
        }
        else{
            return redirect()->back()->withInput()->withErrors($request->all())->with('error','Data gagal disimpan, cek kembali form anda');
        }
    }


    public function ubah($id)
    {
        $dapils      = Dapils::find($id);
        $toptitle   = "Ubah Data Dapil";
        $provinsi   = Provinces::get();
        $kandidat   = Kandidat::get();
        $kabupaten  = Regencies::get();
        //$kandidat = kandidat::get();
        return view('dapil.ubah', compact('toptitle','dapils','provinsi','kabupaten','kandidat'));
    }


    public function update(Request $request)
    {
        $this->validate($request,[
            'id_kandidat' => 'required',
            'id_kabupaten' => 'nullable',
            'id_provinsi' => 'nullable',
            'username' => 'nullable',
            'password' => 'nullable',
        ]);

        $id = $request->id;
        $Dapils = Dapils::find($id);

        $prov = 0;

        if($request->password != null){
            $password = hash('sha256', $request->password);
        }else{
            $password = $Dapils->password;
        }

        Dapils::whereId($id)->update([
            'id_kandidat' => $request->id_kandidat,
            'id_kabupaten' => $request->id_kabupaten,
            'id_provinsi' => $prov,
            'username' => $request->username,
            'password' => $password
        ]);

        return redirect('admin/dapil')->with('success','Data berhasil diubah');
    }


    public function hapus($id)
    {
        $Dapils = Dapils::find($id);
        if($Dapils->delete()){
            return redirect('admin/dapil')->with('success','Data berhasil dihapus');
        }
        else{
            return redirect('admin/dapil')->with('error','Data gagal dihapus');
        }
    }
}
