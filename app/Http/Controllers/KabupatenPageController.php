<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kabupaten;
use App\Models\provinsi;
use Illuminate\Support\Facades\DB; // Import DB class

class kabupatenPageController extends Controller
{
    //Dashboard
    public function home()
    {
        //$products = Product::latest()->paginate(5);
        //$kabupaten = kabupaten::latest()->paginate(5);
        //$kegiatan = Kegiatan::latest()->paginate(5);
        $toptitle = "Dashboard - kabupaten";
        $header = false;
        //$kabupatens = kabupaten::latest()->paginate(5);
        $kabupatens = DB::table('kabupatens')
                      ->join('provinsis','kabupatens.id_propinsi', '=' ,'provinsis.id')
                      ->select('kabupatens.namakabupaten','kabupatens.slug','provinsis.namaprovinsi',
                                'kabupatens.created_at','kabupatens.updated_at','kabupatens.id')->get();
        return view('kabupaten.tabel', compact('header','toptitle','kabupatens'));
        //return view('landingpage.layout');
    }

    public function tambah()
    {
        $toptitle = "Tambah Data kabupaten";
        $header = false;
        $provinsi = provinsi::get();
        //$kandidat = kandidat::get();
        return view('kabupaten.tambah', compact('header','toptitle','provinsi'));
        //return view('landingpage.layout');
    }


    public function simpan(Request $request)
    {
        $this->validate($request,[
            'namakabupaten' => 'required',
            'id_propinsi' => 'required',
            'slug' => 'required'
        ]);
        
        $namakabupatennya = $request->namakabupaten;
        //SlugService::createSlug(Post::class, 'slug', $post->title);

        $kab = kabupaten::create([
            'namakabupaten' => $request->namakabupaten,
            'id_propinsi'   => $request->id_propinsi,
            'slug'          => $request->slug
        ]);

        if($kab){
            return redirect('admin/kabupaten')->with('success','Data berhasil disimpan');
        }
        else{
            return redirect()->back()->withInput()->withErrors($request->all())->with('error','Data gagal disimpan, cek kembali form anda');
        }
    }

    
    public function ubah($id)
    {
        $kabupaten = kabupaten::find($id);
        $toptitle = "Ubah Data kabupaten";
        
        $provinsi = provinsi::get();
        //$kandidat = kandidat::get();
        return view('kabupaten.ubah', ['dataubah' => $kabupaten,'toptitle' => $toptitle,
                    'provinsi' => $provinsi
                    ]);
    }


    public function update(Request $request)
    {
        $this->validate($request,[
            'namakabupaten' => 'required',
            'id_propinsi'   => 'required',
            'slug'          => 'required'
        ]);

        $id = $request->id;
        $kabupatens = kabupaten::find($id);

        kabupaten::whereId($id)->update([
            'namakabupaten' => $request->namakabupaten,
            'slug'          => $request->slug,
            'id_propinsi'   => $request->id_propinsi
        ]);

        return redirect('admin/kabupaten')->with('success','Data berhasil diubah');
    }


    public function hapus($id)
    {
        $kabupatens = kabupaten::find($id);
        if($kabupatens->delete()){
            return redirect('admin/kabupaten')->with('success','Data berhasil dihapus');
        }
        else{
            return redirect('admin/kabupaten')->with('error','Data gagal dihapus');
        }
    }
}
