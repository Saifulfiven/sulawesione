<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\desa;
use App\Models\kecamatan;

class DesaPageController extends Controller
{
    //Dashboard
    public function home()
    {
        $toptitle = "Dashboard - desa";
        $header = false;
        $desas = desa::join('kecamatans',
            'desas.id_kecamatan', '=', 'kecamatans.id')->get();
        return view('desa.tabel', compact('header','toptitle','desas'));
        //return view('landingpage.layout');
    }

    public function tambah()
    {
        $toptitle = "Tambah Data desa";
        $header = false;
        $kecamatan = kecamatan::get();
        return view('desa.tambah', compact('header','toptitle','kecamatan'));
        //return view('landingpage.layout');
    }

    public function simpan(Request $request)
    {
        $this->validate($request,[
            'namadesa' => 'required',
            'id_kecamatan'  => 'required'
        ]);

        $simpan = desa::create([
            'namadesa' => $request->namadesa,
            'id_kecamatan'  => $request->id_kecamatan
        ]);

        if($simpan){
            return redirect('admin/desa')->with('success','Data berhasil disimpan');
        }
        else{
            return redirect()->back()->withInput()->withErrors($request->all())->with('error','Data gagal disimpan, cek kembali form anda');
        }
    }


    public function ubah($id)
    {
        $desa = desa::find($id);
        $kecamatan = kecamatan::pluck('namakecamatan','id');
        $toptitle = "Ubah Data desa";
        return view('desa.ubah', ['dataubah' => $desa,'toptitle' => $toptitle,'kecamatan' => $kecamatan]);
    }


    public function update(Request $request)
    {
        $this->validate($request,[
            'namadesa' => 'required',
            'id_kecamatan'  => 'required'
        ]);

        $id = $request->id;
        $desa = desa::find($id);

        desa::whereId($id)->update([
            'namadesa' => $request->namadesa,
            'id_kecamatan'  => $request->id_kecamatan

        ]);

        return redirect('admin/desa')->with('success','Data berhasil diubah');
    }


    public function hapus($id)
    {
        $desa = desa::find($id);
        if($desa->delete()){
            return redirect('admin/desa')->with('success','Data berhasil dihapus');
        }
        else{
            return redirect('admin/desa')->with('error','Data gagal dihapus');
        }
    }
}
