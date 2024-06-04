<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\timintis;
use App\Models\pemilihs;
use App\Models\pendukungs;
use App\Models\provinsi;
use App\Models\kandidat;
use App\Models\kabupaten;
use App\Models\kecamatan;
use App\Models\Desa;
use App\Models\timpenggunas;
use Illuminate\Support\Facades\DB; // Import DB class

class MasterPageController extends Controller
{
    // Landing Page
    public function index()
    {
        //$products = Product::latest()->paginate(5);
        //$master = master::latest()->paginate(5);
        //$kegiatan = Kegiatan::latest()->paginate(5);
        $master = "master";
        $header = false;
        return view('master.index', compact('master','header'));
        //return view('landingpage.layout');
    }


    //Dashboard

    public function timinti()
    {
        //$products = Product::latest()->paginate(5);
        //$master = master::latest()->paginate(5);
        //$kegiatan = Kegiatan::latest()->paginate(5);
        $toptitle = "Tim Inti";
        $header = false;

        $timintis = timpenggunas::where('timpenggunas.jenistim', 'A')
                                ->join('dapils', 'timpenggunas.id_dapil', '=', 'dapils.id')
                                ->join('kandidats', 'kandidats.id', '=', 'dapils.id_kandidat')
                                ->join('kabupatens', 'kabupatens.id', '=', 'dapils.id_kabupaten')
                                ->select('timpenggunas.nama','timpenggunas.kontak','timpenggunas.email',
                                         'kandidats.namakandidat','kabupatens.namakabupaten')->get();
        return view('master.timinti', compact('header','toptitle','timintis'));
        //return view('landingpage.layout');
    }

    public function pendukung()
    {
        //$products = Product::latest()->paginate(5);
        //$master = master::latest()->paginate(5);
        //$kegiatan = Kegiatan::latest()->paginate(5);
        $toptitle = "Pendukung";
        $header = false;


        $pendukungs = timpenggunas::where('timpenggunas.jenistim', 'B')
                                ->join('dapils', 'timpenggunas.id_dapil', '=', 'dapils.id')
                                ->join('kandidats', 'kandidats.id', '=', 'dapils.id_kandidat')
                                ->join('kabupatens', 'kabupatens.id', '=', 'dapils.id_kabupaten')
                                ->select('timpenggunas.nama','timpenggunas.kontak','timpenggunas.email',
                                    'kandidats.namakandidat','kabupatens.namakabupaten')->get();
       return view('master.pendukung', compact('header','toptitle','pendukungs'));
        //return view('landingpage.layout');
    }


    // PILGUB
    public function timintipilgub()
    {
        //$products = Product::latest()->paginate(5);
        //$master = master::latest()->paginate(5);
        //$kegiatan = Kegiatan::latest()->paginate(5);
        $toptitle = "Tim Inti";
        $header = false;

        $timintipilgubs = timpenggunas::where('timpenggunas.jenistim', 'A')
                                ->join('dapils', 'timpenggunas.id_dapil', '=', 'dapils.id')
                                ->join('kandidats', 'kandidats.id', '=', 'dapils.id_kandidat')
                                ->join('provinsis', 'provinsis.id', '=', 'dapils.id_provinsi')
                                ->select('timpenggunas.nama','timpenggunas.kontak','timpenggunas.email','kandidats.namakandidat',
                                    'provinsis.namaprovinsi')->get();
        return view('master.timintipilgub', compact('header','toptitle','timintipilgubs'));
        //return view('landingpage.layout');
    }

    public function pendukungpilgub()
    {
        //$products = Product::latest()->paginate(5);
        //$master = master::latest()->paginate(5);
        //$kegiatan = Kegiatan::latest()->paginate(5);
        $toptitle = "Tim Pendukung Pilgub";
        $header = false;


        $pendukungpilgubs = timpenggunas::where('timpenggunas.jenistim', 'B')
                                ->join('dapils', 'timpenggunas.id_dapil', '=', 'dapils.id')
                                ->join('kandidats', 'kandidats.id', '=', 'dapils.id_kandidat')
                                ->join('provinsis', 'provinsis.id', '=', 'dapils.id_provinsi')
                                ->select('timpenggunas.nama','timpenggunas.kontak','kandidats.namakandidat','provinsis.namaprovinsi')->get();
       return view('master.pendukungpilgub', compact('header','toptitle','pendukungpilgubs'));
        //return view('landingpage.layout');
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

    // Search Desa
    public function searchdesa(Request $request)
    {
        $desa = Desa::select('id','namadesa')
            ->where('id_kecamatan',$request->id_kecamatan)->get();
        return response()->json($desa);
    }


    public function searchpemilih(Request $request)
    {
        $id_provinsi = $request->id_provinsi;
        $id_kabupaten = $request->id_kabupaten;
        $id_kecamatan = $request->id_kecamatan;
        $id_dapil     = $request->id_kandidat;

//
//        $pemilihs = Pemilihs::where('id_provinsi', $id_provinsi)
//            ->Where('id_kabupaten', $id_kabupaten)
//            ->Where('id_kecamatan', $id_kecamatan)
//            ->Where('id_dapil', $id_kandidat)->get();


        $pemilihs = DB::table('pemilihs')
            ->join('provinsis', 'pemilihs.id_provinsi', '=', 'provinsis.id')
            ->join('kabupatens', 'pemilihs.id_kabupaten', '=', 'kabupatens.id')
            ->join('kecamatans', 'pemilihs.id_kecamatan', '=', 'kecamatans.id')
            ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
            ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
            ->join('desas', 'pemilihs.id_desa', '=', 'desas.id')
            ->join('timpenggunas', 'pemilihs.id_timpengguna', '=', 'timpenggunas.id') // Added join to table kandidats
                 ->select('pemilihs.nama','pemilihs.kontak','pemilihs.jenispilihan','pemilihs.created_at','desas.namadesa',
                'kecamatans.namakecamatan','kabupatens.namakabupaten','provinsis.namaprovinsi',
                'kandidats.namakandidat',
                'timpenggunas.nama as namapengguna')
            ->where('pemilihs.id_provinsi', '=', $id_provinsi)
            ->Where('pemilihs.id_kabupaten', '=', $id_kabupaten)
            ->Where('pemilihs.id_kecamatan', '=', $id_kecamatan)
            ->Where('pemilihs.id_dapil', '=', $id_dapil)
            ->Where('dapils.jeniskandidat','=','pilkab')->get();

        return response()->json($pemilihs);

    }

    public function pemilihpilkab()
    {
        $toptitle = "Pemilih Pilkab";
        $header = false;

        $provinsi = provinsi::select('id','namaprovinsi')->get();
        $dapils = DB::table('dapils')
            ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
            ->select('kandidats.namakandidat','dapils.id')
            ->where('dapils.jeniskandidat', 'pilkab')->get();

        $pemilihs = DB::table('pemilihs')
            ->join('desas', 'pemilihs.id_desa', '=', 'desas.id')
            ->join('kecamatans', 'pemilihs.id_kecamatan', '=', 'kecamatans.id')
        ->join('kabupatens', 'pemilihs.id_kabupaten', '=', 'kabupatens.id')
        ->join('provinsis', 'kabupatens.id_propinsi', '=', 'provinsis.id')
        ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
        ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
        ->join('timpenggunas', 'pemilihs.id_timpengguna', '=', 'timpenggunas.id') // Added join to table kandidats
        ->select('pemilihs.nama','pemilihs.kontak','pemilihs.jenispilihan','pemilihs.created_at','desas.namadesa',
                 'kecamatans.namakecamatan','kabupatens.namakabupaten','provinsis.namaprovinsi',
                 'kandidats.namakandidat',
                 'timpenggunas.nama as namapengguna')
        ->Where('dapils.jeniskandidat','=','pilkab')->get();

        return view('master.pemilih', compact('header','toptitle','pemilihs','provinsi','dapils'));
        //return view('landingpage.layout');
    }

    public function pemilihpilgub()
    {
        $toptitle = "Pemilih Pilgub";
        $header = false;

        $provinsi = provinsi::select('id','namaprovinsi')->get();
        $dapils = DB::table('dapils')
            ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
            ->select('kandidats.namakandidat','dapils.id')
            ->where('dapils.jeniskandidat', 'pilkab')->get();

        $pemilihs = DB::table('pemilihs')
            ->join('desas', 'pemilihs.id_desa', '=', 'desas.id')
            ->join('kecamatans', 'pemilihs.id_kecamatan', '=', 'kecamatans.id')
            ->join('kabupatens', 'pemilihs.id_kabupaten', '=', 'kabupatens.id')
            ->join('provinsis', 'kabupatens.id_propinsi', '=', 'provinsis.id')
            ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
            ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
            ->join('timpenggunas', 'pemilihs.id_timpengguna', '=', 'timpenggunas.id') // Added join to table kandidats
            ->select('pemilihs.nama','pemilihs.kontak','pemilihs.jenispilihan','pemilihs.created_at','desas.namadesa',
                'kecamatans.namakecamatan','kabupatens.namakabupaten','provinsis.namaprovinsi',
                'kandidats.namakandidat',
                'timpenggunas.nama as namapengguna')
            ->Where('dapils.jeniskandidat','=','pilgub')->get();

        return view('master.pemilih', compact('header','toptitle','pemilihs','provinsi','dapils'));
        //return view('landingpage.layout');
    }

    public function tambah()
    {
        //$products = Product::latest()->paginate(5);
        //$master = master::latest()->paginate(5);
        //$kegiatan = Kegiatan::latest()->paginate(5);
        $toptitle = "Tambah Data master";
        $header = false;
        return view('master.tambah', compact('header','toptitle'));
        //return view('landingpage.layout');
    }


    public function simpan(Request $request)
    {
        $this->validate($request,[
            'judul' => 'required',
            'nama' => 'required',
            'programstudi' => 'required',
            'angkatan' => 'nullable',
            'jabatan' => 'nullable',
            'pekerjaan' => 'nullable',
            'detail' => 'required',
            'foto' => 'required|image|mimes:jpeg,jpg,png'
        ]);

        //upload foto
        $foto = $request->foto;
        $namafile = time()."_".$foto->getClientOriginalName();
        $tujuan_upload = 'images/master';
        $foto->move($tujuan_upload,$namafile);

        $judulnya = $request->judul;
        //SlugService::createSlug(Post::class, 'slug', $post->title);

        masters::create([
            'judul' => $request->judul,
            'nama' => $request->nama,
            'programstudi' => $request->programstudi,
            'angkatan' => $request->angkatan,
            'jabatan' => $request->jabatan,
            'pekerjaan' => $request->pekerjaan,
            'detail' => $request->detail,
            'foto' => $namafile
        ]);

        if($foto){
            return redirect('admin/master/home')->with('success','Data berhasil disimpan');
        }
        else{
            return redirect()->back()->withInput()->withErrors($request->all())->with('error','Data gagal disimpan, cek kembali form anda');
        }
    }


    public function ubah($id)
    {
        $masters = masters::find($id);
        $toptitle = "Ubah Data master";
        return view('master.ubah', ['dataubah' => $masters,'toptitle' => $toptitle]);
    }


    public function update(Request $request)
    {
        $this->validate($request,[
            'judul' => 'required',
            'nama' => 'required',
            'programstudi' => 'required',
            'angkatan' => 'nullable',
            'jabatan' => 'nullable',
            'pekerjaan' => 'nullable',
            'detail' => 'nullable',
            'foto' => 'image|mimes:jpeg,jpg,png'
        ]);

        $id = $request->id;
        $masters = masters::find($id);
        $foto = $request->foto;
        if($foto){
            $namafile = time()."_".$foto->getClientOriginalName();
            $tujuan_upload = 'images/master';
            $foto->move($tujuan_upload,$namafile);
        }
        else{
            $namafile = $masters->foto;
        }

        masters::whereId($id)->update([
            'judul' => $request->judul,
            'nama' => $request->nama,
            'programstudi' => $request->programstudi,
            'angkatan' => $request->angkatan,
            'jabatan' => $request->jabatan,
            'pekerjaan' => $request->pekerjaan,
            'detail' => $request->detail,
            'foto' => $namafile
        ]);

        return redirect('admin/master/home')->with('success','Data berhasil diubah');
    }


    public function hapus($id)
    {
        $masters = masters::find($id);
        $namafile = $masters->foto;
        File::delete('/images/master/'.$namafile);
        if($masters->delete()){
            return redirect('admin/master/home')->with('success','Data berhasil dihapus');
        }
        else{
            return redirect('admin/master/home')->with('error','Data gagal dihapus');
        }
    }
}
