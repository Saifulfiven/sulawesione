<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acaras;
use Cviebrock\EloquentSluggable\Services\SlugService;

use Illuminate\Support\Str;

class AcaraPageController extends Controller
{
    
    public function index()
    {
        //$products = Product::latest()->paginate(5);
        //$berita = Berita::latest()->paginate(5);
        //$kegiatan = Kegiatan::latest()->paginate(5);
        $toptitle = "STIE NOBEL :. Acara";
        $header = false;
        $acaras = Acaras::latest()->paginate(5);
        return view('acara.tabel', compact('header','toptitle','acaras'));
        //return view('landingpage.layout');
    }

    public function tambah()
    {
        //$products = Product::latest()->paginate(5);
        //$berita = Berita::latest()->paginate(5);
        //$kegiatan = Kegiatan::latest()->paginate(5);
        $toptitle = "STIE NOBEL :. Tambah Data Acara";
        $header = false;
        return view('acara.tambah', compact('header','toptitle'));
        //return view('landingpage.layout');
    }


    public function simpan(Request $request)
    {
        $this->validate($request,[
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required',
            'jam' => 'required',
            'linksatu' => 'nullable',
            'judullinksatu' => 'nullable',
            'linkdua' => 'nullable',
            'judullinkdua' => 'nullable',
            'gambar' => 'required|image|mimes:jpeg,jpg,png'
        ]);
        
        //upload gambar
        $gambar = $request->gambar;
        $namafile = time()."_".$gambar->getClientOriginalName();
        $tujuan_upload = 'images/acara';
        $gambar->move($tujuan_upload,$namafile);

        $judulnya = $request->judul;
        //SlugService::createSlug(Post::class, 'slug', $post->title);

        Acaras::create([
            'judul' => $request->judul,
            'slug' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'linksatu' => $request->linksatu,
            'judullinksatu' => $request->judullinksatu,
            'linkdua' => $request->linkdua,
            'judullinkdua' => $request->judullinkdua,
            'gambar' => $namafile
        ]);

        if($gambar){
            return redirect('admin/acara')->with('success','Data berhasil disimpan');
        }
        else{
            return redirect()->back()->withInput()->withErrors($request->all())->with('error','Data gagal disimpan, cek kembali form anda');
        }
    }

    
    public function ubah($id)
    {
        $acaras = Acaras::find($id);
        $toptitle = "STIE NOBEL :. Tambah Ubah Data Acara";
        return view('acara.ubah', ['dataubah' => $acaras,'toptitle' => $toptitle]);
    }


    public function update(Request $request)
    {
        $this->validate($request,[
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required',
            'jam' => 'required',
            'linksatu' => 'nullable',
            'judullinksatu' => 'nullable',
            'linkdua' => 'nullable',
            'judullinkdua' => 'nullable',
            'gambar' => 'image|mimes:jpeg,jpg,png'
        ]);

        $id = $request->id;
        $acaras = Acaras::find($id);
        $gambar = $request->gambar;
        if($gambar){
            $namafile = time()."_".$gambar->getClientOriginalName();
            $tujuan_upload = 'images/acara';
            $gambar->move($tujuan_upload,$namafile);
        }
        else{
            $namafile = $acaras->gambar;
        }

        Acaras::whereId($id)->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'linksatu' => $request->linksatu,
            'judullinksatu' => $request->judullinksatu,
            'linkdua' => $request->linkdua,
            'judullinkdua' => $request->judullinkdua,
            'gambar' => $namafile
        ]);

        return redirect('admin/acara')->with('success','Data berhasil diubah');
    }


    public function hapus($id)
    {
        $acaras = Acaras::find($id);
        $namafile = $acaras->gambar;
        File::delete('images/acara/'.$namafile);
        if($acaras->delete()){
            return redirect('admin/acara')->with('success','Data berhasil dihapus');
        }
        else{
            return redirect('admin/acara')->with('error','Data gagal dihapus');
        }
    }


}
