<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dapils;
use App\Models\provinsi;
use App\Models\kandidat;
use App\Models\kabupaten;
use Illuminate\Support\Facades\DB; // Import DB class

class DapilPageController extends Controller
{
    //Dashboard
    public function index()
    {
        //$products = Product::latest()->paginate(5);
        //$Dapil = Dapils::latest()->paginate(5);
        //$kegiatan = Kegiatan::latest()->paginate(5);
        $toptitle = "SulawesiOne :. Dashboard - Dapil";
        $header = false;
        //$Dapils = Dapils::latest()->paginate(5);
        $Dapilkab = DB::table('dapils')
                        ->join('kabupatens','dapils.id_kabupaten', '=' ,'kabupatens.id')
                        ->join('kandidats','dapils.id_kandidat', '=' ,'kandidats.id')
                        ->where('dapils.jeniskandidat','=','pilkab')
                      //->join('provinsis','Dapils.id_propinsi', '=' ,'provinsis.id')
                      ->select('kandidats.namakandidat','kabupatens.namakabupaten',
                                'dapils.created_at','dapils.updated_at','dapils.id')->get();

        
        $Dapilprov = DB::table('dapils')
        ->join('kandidats','dapils.id_kandidat', '=' ,'kandidats.id')
        ->join('provinsis','dapils.id_provinsi', '=' ,'provinsis.id')
        ->where('dapils.jeniskandidat','=','pilgub')
        ->select('kandidats.namakandidat','provinsis.namaprovinsi',
                'dapils.created_at','dapils.updated_at','dapils.id')->get();
        return view('Dapil.tabel', compact('header','toptitle','Dapilkab','Dapilprov'));
        //return view('landingpage.layout');
    }

    public function tambah()
    {
        $toptitle = "SulawesiOne :. Tambah Data Dapil";
        $header = false;
        $provinsi = provinsi::get();
        $kandidat = Kandidat::get();
        $kabupaten = kabupaten::get();
        //$kandidat = kandidat::get();
        return view('Dapil.tambah', compact('header','toptitle','kandidat','provinsi','kabupaten'));
        //return view('landingpage.layout');
    }


    public function simpan(Request $request)
    {
        $this->validate($request,[
            'id_kandidat'   => 'required',
            'id_kabupaten'  => 'nullable',
            'id_propinsi'   => 'nullable',
            'jeniskandidat' => 'nullable'
        ]);
        
        $namaDapilnya = $request->namaDapil;
        //SlugService::createSlug(Post::class, 'slug', $post->title);

        $jenis = $request->jeniskandidat;
        if($jenis == "pilgub"){
            $prov = $request->id_propinsi;
            $kab  = 0;
        }else{
            $kab = $request->id_kabupaten;
            $prov = 0;
        }
        $kab = Dapils::create([
            'id_kandidat'   => $request->id_kandidat,
            'id_kabupaten'  => $kab,
            'id_propinsi'   => $prov,
            'jeniskandidat' => $request->jeniskandidat
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
        $Dapil      = Dapils::find($id);
        $toptitle   = "SulawesiOne :. Ubah Data Dapil";
        
        $provinsi   = provinsi::get();
        $kandidat   = Kandidat::get();
        $kabupaten  = kabupaten::get();
        //$kandidat = kandidat::get();
        return view('Dapil.ubah', ['dataubah' => $Dapil,
                    'toptitle'  => $toptitle,
                    'kandidat'  => $kandidat,
                    'kabupaten' => $kabupaten,
                    'provinsi'  => $provinsi
                    ]);
    }


    public function update(Request $request)
    {
        $this->validate($request,[
            'id_kandidat' => 'required',
            'id_kabupaten' => 'required',
            'id_propinsi' => 'required'
        ]);

        $id = $request->id;
        $Dapils = Dapils::find($id);

        Dapils::whereId($id)->update([
            'id_kandidat' => $request->id_kandidat,
            'id_kabupaten' => $request->id_kabupaten,
            'id_propinsi' => $request->id_propinsi
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
