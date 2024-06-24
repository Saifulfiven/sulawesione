<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beritas;

class BeritaPageController extends Controller
{
    // Landing Page
    public function index()
    {
        //$products = Product::latest()->paginate(5);
        //$berita = Berita::latest()->paginate(5);
        //$kegiatan = Kegiatan::latest()->paginate(5);
        $berita = "Berita";
        $header = false;
        return view('berita.index', compact('berita','header'));
        //return view('landingpage.layout');
    }

    //Dashboard
    public function home()
    {
        //$products = Product::latest()->paginate(5);
        //$berita = Berita::latest()->paginate(5);
        //$kegiatan = Kegiatan::latest()->paginate(5);
        $toptitle = "Dashboard - Berita";
        $header = false;
        $beritas = beritas::latest()->paginate(5);
        return view('berita.tabel', compact('header','toptitle','beritas'));
        //return view('landingpage.layout');
    }

    public function tambah()
    {
        //$products = Product::latest()->paginate(5);
        //$berita = Berita::latest()->paginate(5);
        //$kegiatan = Kegiatan::latest()->paginate(5);
        $toptitle = "Tambah Data berita";
        $header = false;
        return view('berita.tambah', compact('header','toptitle'));
        //return view('landingpage.layout');..
    }


    public function simpan(Request $request)
    {
        $this->validate($request,[
            'judul' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image|mimes:jpeg,jpg,png'
        ]);

        //upload gambar
        $gambar = $request->gambar;
        $namafile = time()."_".$gambar->getClientOriginalName();
        $tujuan_upload = 'images/berita';
        $gambar->move($tujuan_upload,$namafile);

        $judulnya = $request->judul;
        //SlugService::createSlug(Post::class, 'slug', $post->title);

        beritas::create([
            'judul'     => $request->judul,
            'slug'      => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar'    => $namafile
        ]);

        if($gambar){
            return redirect('admin/berita')->with('success','Data berhasil disimpan');
        }
        else{
            return redirect()->back()->withInput()->withErrors($request->all())->with('error','Data gagal disimpan, cek kembali form anda');
        }
    }


    public function ubah($id)
    {
        $beritas = beritas::find($id);
        $toptitle = "Ubah Data berita";
        return view('berita.ubah', ['dataubah' => $beritas,'toptitle' => $toptitle]);
    }


    public function update(Request $request)
    {
        $this->validate($request,[
            'judul' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'image|mimes:jpeg,jpg,png'
        ]);

        $id = $request->id;
        $beritas = beritas::find($id);
        $gambar = $request->gambar;
        if($gambar){
            $namafile = time()."_".$gambar->getClientOriginalName();
            $tujuan_upload = 'images/berita';
            $gambar->move($tujuan_upload,$namafile);
        }
        else{
            $namafile = $beritas->gambar;
        }

        beritas::whereId($id)->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar' => $namafile
        ]);

        return redirect('admin/berita')->with('success','Data berhasil diubah');
    }


    public function hapus($id)
    {
        $beritas = beritas::find($id);
        $namafile = $beritas->gambar;
        File::delete('/images/berita/'.$namafile);
        if($beritas->delete()){
            return redirect('admin/berita')->with('success','Data berhasil dihapus');
        }
        else{
            return redirect('admin/berita')->with('error','Data gagal dihapus');
        }
    }
}
