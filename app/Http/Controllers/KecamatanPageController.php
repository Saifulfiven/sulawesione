<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kecamatan;
use App\Models\kabupaten;

class KecamatanPageController extends Controller
{
    //Dashboard
    public function home()
    {
        $toptitle = "PILKADA 2024:. Dashboard - kecamatan";
        $header = false;
        $kecamatans = kecamatan::join('kabupatens', 
                      'kecamatans.id_kabupaten', '=', 'kabupatens.id')->get();
        return view('kecamatan.tabel', compact('header','toptitle','kecamatans'));
        //return view('landingpage.layout');
    }

    public function tambah()
    {
        $toptitle = "PILKADA 2024:. Tambah Data kecamatan";
        $header = false;
        $kabupaten = kabupaten::get();
        return view('kecamatan.tambah', compact('header','toptitle','kabupaten'));
        //return view('landingpage.layout');
    }

    public function simpan(Request $request)
    {
        $this->validate($request,[
            'namakecamatan' => 'required',
            'id_kabupaten'  => 'required'
        ]);
        
        $simpan = kecamatan::create([
            'namakecamatan' => $request->namakecamatan,
            'id_kabupaten' => $request->id_kabupaten
        ]);

        if($simpan){
            return redirect('admin/kecamatan')->with('success','Data berhasil disimpan');
        }
        else{
            return redirect()->back()->withInput()->withErrors($request->all())->with('error','Data gagal disimpan, cek kembali form anda');
        }
    }

    
    public function ubah($id)
    {
        $kecamatan = kecamatan::find($id);
        $kabupaten = kabupaten::pluck('namakabupaten','id');
        $toptitle = "PILKADA 2024:. Ubah Data kecamatan";
        return view('kecamatan.ubah', ['dataubah' => $kecamatan,'toptitle' => $toptitle,'kabupaten' => $kabupaten]);
    }


    public function update(Request $request)
    {
        $this->validate($request,[
            'namakecamatan' => 'required',
            'id_kabupaten'  => 'required'
        ]);

        $id = $request->id;
        $kecamatan = kecamatan::find($id);

        kecamatan::whereId($id)->update([
            'namakecamatan' => $request->namakecamatan,
            'id_kabupaten' => $request->id_kabupaten,
        ]);

        return redirect('admin/kecamatan')->with('success','Data berhasil diubah');
    }


    public function hapus($id)
    {
        $kecamatan = kecamatan::find($id);
        if($kecamatan->delete()){
            return redirect('admin/kecamatan')->with('success','Data berhasil dihapus');
        }
        else{
            return redirect('admin/kecamatan')->with('error','Data gagal dihapus');
        }
    }
}
