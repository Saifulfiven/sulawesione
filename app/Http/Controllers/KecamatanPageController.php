<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Districts;
use App\Models\Regencies;

use Illuminate\Support\Facades\DB; // Import DB class

class KecamatanPageController extends Controller
{
    //Dashboard
    public function home()
    {
        $toptitle = "Dashboard - kecamatan";
        $header = false;
        $kecamatans = DB::table('districts')
                    ->join('regencies', 'districts.regency_id', '=', 'regencies.id')
                    ->select('regencies.name as namakabupaten','districts.id','districts.name as namakecamatan','districts.created_at')
                    ->get();
        return view('kecamatan.tabel', compact('header','toptitle','kecamatans'));
        //return view('landingpage.layout');
    }

    public function tambah()
    {
        $toptitle = "Tambah Data kecamatan";
        $header = false;
        $kabupaten = Regencies::get();
        return view('kecamatan.tambah', compact('header','toptitle','kabupaten'));
        //return view('landingpage.layout');
    }

    public function simpan(Request $request)
    {
        $this->validate($request,[
            'namakecamatan' => 'required',
            'slug'          => 'required',
            'regency_id'  => 'required'
        ]);

        $simpan = kecamatan::create([
            'name'        => $request->namakecamatan,
            'regency_id'  => $request->regency_id,
            'slug'        => $request->slug
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
        $toptitle = "Ubah Data kecamatan";
        return view('kecamatan.ubah', ['dataubah' => $kecamatan,'toptitle' => $toptitle,'kabupaten' => $kabupaten]);
    }


    public function update(Request $request)
    {
        $this->validate($request,[
            'namakecamatan' => 'required',
            'slug'          => 'required',
            'regency_id'  => 'required'
        ]);

        $id = $request->id;
        $kecamatan = kecamatan::find($id);

        Regencies::whereId($id)->update([
            'name'          => $request->namakecamatan,
            'regency_id'    => $request->regency_id,
            'slug'          => $request->slug,
        ]);

        return redirect('admin/kecamatan')->with('success','Data berhasil diubah');
    }


    public function hapus($id)
    {
        $kecamatan = Regencies::find($id);
        if($kecamatan->delete()){
            return redirect('admin/kecamatan')->with('success','Data berhasil dihapus');
        }
        else{
            return redirect('admin/kecamatan')->with('error','Data gagal dihapus');
        }
    }
}
