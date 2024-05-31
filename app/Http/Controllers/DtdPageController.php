<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\provinsi;
use App\Models\pemilihs;
use Illuminate\Support\Facades\DB;
use session;

class DtdPageController extends Controller
{
    
    public function index()
    {
        $toptitle = "Survey Pemilu 2024";
        $header = false;
        $jeniskandidatx = "Pemilih";
        $id_timpengguna = session('id_timpengguna');
        $dapatkandapil  = DB::table('timpenggunas')
                        ->join('dapils','timpenggunas.id_dapil','=','dapils.id')
                        ->select('dapils.jeniskandidat','dapils.id as id_dapil',
                                 'timpenggunas.id as id_timpengguna')
                        ->Where('timpenggunas.id', '=' , $id_timpengguna)
                        ->first();
                        
        
        $provinsi = Provinsi::all();
        return view('dataform.pemilih-register', 
               compact('header','toptitle','provinsi','jeniskandidatx','dapatkandapil'));
    }
    
    public function pemilihstore(Request $request)
    {
        
        $this->validate($request,[
            'id_kabupaten'     => 'required',
            'nama'             => 'nullable',
            'id_dapil'         => 'required',
            'id_kecamatan'     => 'nullable',
            'id_kabupaten'     => 'nullable',
            'id_provinsi'      => 'nullable',
            'kontak'           => 'nullable',
            'jenispilihan'     => 'nullable',
        ]);

        $id_timpengguna = session('id_timpengguna');
        // insert data ke tabel kedua
        $pemilih = pemilihs::create([
            'id_timpengguna'  => $id_timpengguna,
            'id_dapil'        => $request->id_dapil,
            'nama'            => $request->nama,
            'id_kecamatan'    => $request->kecamatan,
            'id_kabupaten'    => $request->kabupaten,
            'id_provinsi'     => $request->provinsi,
            'desa'            => $request->desa,
            'kontak'          => $request->kontak,
            'jenispilihan'    => $request->jenispilihan, // Isi Survey
        ]);

        if($pemilih){
            return redirect('dtd/sukses')->with('success','Data berhasil disimpan');
        }
        else{
            return redirect()->back()->withInput()->withErrors($request->all())->with('error','Data gagal disimpan, cek kembali form anda');
        }
    }

    public function sukses()
    {
        $toptitle = "Berhasil Input Data Pemilih";
        $header = false;
        return view('dataform.sukses-dtd', compact('header','toptitle'));
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

    
    

}
