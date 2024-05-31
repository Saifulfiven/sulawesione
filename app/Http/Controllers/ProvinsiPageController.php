<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\provinsi;

class provinsiPageController extends Controller
{
    // Landing Page
    public function index()
    {
        $provinsi = "Provinsi";
        $header = false;
        return view('provinsi.index', compact('provinsi','header'));

    }

    //Dashboard
    public function home()
    {
        $toptitle = "Dashboard - Provinsi";
        $header = false;
        $provinsis = provinsi::all();
        return view('provinsi.tabel', compact('header','toptitle','provinsis'));
        //return view('landingpage.layout');
    }

    public function tambah()
    {
        $toptitle = "Tambah Data provinsi";
        $header = false;
        return view('provinsi.tambah', compact('header','toptitle'));
        //return view('landingpage.layout');
    }


    public function simpan(Request $request)
    {
        $this->validate($request,[
            'namaprovinsi' => 'required',
            'slug'         => 'required'
        ]);
        
        $simpan = provinsi::create([
            'namaprovinsi' => $request->namaprovinsi,
            'slug'         => $request->slug
        ]);

        if($simpan){
            return redirect('admin/provinsi')->with('success','Data berhasil disimpan');
        }
        else{
            return redirect()->back()->withInput()->withErrors($request->all())->with('error','Data gagal disimpan, cek kembali form anda');
        }
    }

    
    public function ubah($id)
    {
        $provinsi = provinsi::find($id);
        $toptitle = "Ubah Data provinsi";
        return view('provinsi.ubah', ['dataubah' => $provinsi,'toptitle' => $toptitle]);
    }


    public function update(Request $request)
    {
        $this->validate($request,[
            'namaprovinsi'  => 'required',
            'slug'          => 'required'
        ]);

        $id = $request->id;
        $provinsi = provinsi::find($id);

        provinsi::whereId($id)->update([
            'namaprovinsi' => $request->namaprovinsi,
            'slug'         => $request->slug
        ]);

        return redirect('admin/provinsi')->with('success','Data berhasil diubah');
    }


    public function hapus($id)
    {
        $provinsi = provinsi::find($id);
        if($provinsi->delete()){
            return redirect('admin/provinsi')->with('success','Data berhasil dihapus');
        }
        else{
            return redirect('admin/provinsi')->with('error','Data gagal dihapus');
        }
    }
}
