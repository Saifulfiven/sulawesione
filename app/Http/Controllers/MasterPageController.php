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
        $toptitle = "Dashboard - Tim Inti";
        $header = false;
        
        $timintis = timpenggunas::where('timpenggunas.jenistim', 'A')
                                ->join('dapils', 'timpenggunas.id_dapil', '=', 'dapils.id')
                                ->join('kandidats', 'kandidats.id', '=', 'dapils.id_kandidat')
                                ->join('kabupatens', 'kabupatens.id', '=', 'dapils.id_kabupaten')
                                ->select('timpenggunas.nama','timpenggunas.kontak','kandidats.namakandidat','kabupatens.namakabupaten')->get();
        return view('master.timinti', compact('header','toptitle','timintis'));
        //return view('landingpage.layout');
    }

    public function pendukung()
    {
        //$products = Product::latest()->paginate(5);
        //$master = master::latest()->paginate(5);
        //$kegiatan = Kegiatan::latest()->paginate(5);
        $toptitle = "Dashboard - Pendukung";
        $header = false;
        
        
        $pendukungs = timpenggunas::where('timpenggunas.jenistim', 'B')
                                ->join('dapils', 'timpenggunas.id_dapil', '=', 'dapils.id')
                                ->join('kandidats', 'kandidats.id', '=', 'dapils.id_kandidat')
                                ->join('kabupatens', 'kabupatens.id', '=', 'dapils.id_kabupaten')
                                ->select('timpenggunas.nama','timpenggunas.kontak','kandidats.namakandidat','kabupatens.namakabupaten')->get();
       return view('master.pendukung', compact('header','toptitle','pendukungs'));
        //return view('landingpage.layout');
    }


    // PILGUB
    public function timintipilgub()
    {
        //$products = Product::latest()->paginate(5);
        //$master = master::latest()->paginate(5);
        //$kegiatan = Kegiatan::latest()->paginate(5);
        $toptitle = "Dashboard - Tim Inti";
        $header = false;
        
        $timintipilgubs = timpenggunas::where('timpenggunas.jenistim', 'A')
                                ->join('dapils', 'timpenggunas.id_dapil', '=', 'dapils.id')
                                ->join('kandidats', 'kandidats.id', '=', 'dapils.id_kandidat')
                                ->join('provinsis', 'provinsis.id', '=', 'dapils.id_provinsi')
                                ->select('timpenggunas.nama','timpenggunas.kontak','kandidats.namakandidat','provinsis.namaprovinsi')->get();
        return view('master.timintipilgub', compact('header','toptitle','timintipilgubs'));
        //return view('landingpage.layout');
    }

    public function pendukungpilgub()
    {
        //$products = Product::latest()->paginate(5);
        //$master = master::latest()->paginate(5);
        //$kegiatan = Kegiatan::latest()->paginate(5);
        $toptitle = "Dashboard - Pendukung";
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

    
    public function searchpemilih(Request $request)
    {
        $id_provinsi = $request->id_provinsi;
        $id_kabupaten = $request->id_kabupaten;
        $id_kecamatan = $request->id_kecamatan;
        $id_kandidat = $request->id_kandidat;

        
        $pemilihs = Pemilihs::where('id_kabupaten', $id_kabupaten)
                            ->orWhere('id_kecamatan', $id_kecamatan)->get();

        $callback = "<thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Kontak</th>
          <th>Jenis Pilihan</th>
          <th>Kandidat</th>
          <th>Provinsi</th>
          <th>Kabupaten</th>
          <th>Kecamatan</th>
          <th>Pengguna</th>
        </tr>
      </thead>
        <tbody>";
        if ($pemilihs) {
            foreach($pemilihs as $data){
                
            $callback .= "<tr>";
                $callback .= "<td>".$data->nama."</td>";
                $callback .= "<td>".$data->kontak."</td>";
                $callback .= "<td>".$data->jenispilihan."</td>";
                $callback .= "<td>".$data->id_kecamatan."</td>";
                $callback .= "<td>".$data->id_kabupaten."</td>";
                $callback .= "<td>".$data->id_timpengguna."</td>";
                $callback .= "<td>".$data->kontak."</td>";
                $callback .= "<td>".$data->kontak."</td>";
                $callback .= "<td>".$data->nama."</td>"; // Tambahkan tag option ke variabel $lists
                
            $callback .= "</tr>";
            }

        } else {
            $callback = "<tr>
                         <td colspan='4' align='center' style='color:red'>Data tidak ditemukan</td>
                         </tr>";
        }
    
        $callback .= "</tbody>";
        $callbacks = array($callback); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota

        echo json_encode($callbacks);
        //echo json_encode($callbacks);
        // $callback = "<tr>
        //              <td> $id_provinsi</td><td> $id_kabupaten</td>
        //              <td> $id_kecamatan</td><td> $id_kandidat</td></tr>";
        // echo json_encode($callback);
        // return response()->json([
        //     'id_provinsi' => $id_provinsi,
        //     'id_kabupaten' => $id_kabupaten,
        //     'id_kecamatan' => $id_kecamatan,
        //     'id_kandidat' => $id_kandidat,
        // ]);
    }

    public function pemilihpilkab()
    {
        $toptitle = "Dashboard - Pemilih Pilkab";
        $header = false;

        $provinsi = provinsi::select('id','namaprovinsi')->get();
        $kandidats = kandidat::select('id','namakandidat')->get();

        $pemilihs = DB::table('pemilihs')
        ->join('kecamatans', 'pemilihs.id_kecamatan', '=', 'kecamatans.id')
        ->join('kabupatens', 'pemilihs.id_kabupaten', '=', 'kabupatens.id')
        ->join('provinsis', 'kabupatens.id_propinsi', '=', 'provinsis.id')
        ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
        ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
        ->join('timpenggunas', 'pemilihs.id_timpengguna', '=', 'timpenggunas.id') // Added join to table kandidats
        ->select('pemilihs.nama','pemilihs.kontak','pemilihs.jenispilihan','pemilihs.desa',
                 'kecamatans.namakecamatan','kabupatens.namakabupaten','provinsis.namaprovinsi',
                 'kandidats.namakandidat',
                 'timpenggunas.nama as namapengguna')
        ->Where('dapils.jeniskandidat','=','pilkab')->get();
        
        return view('master.pemilih', compact('header','toptitle','pemilihs','provinsi','kandidats'));
        //return view('landingpage.layout');
    }

    public function pemilihpilgub()
    {
        $toptitle = "Dashboard - Pemilih Pilgub";
        $header = false;

        $provinsi = provinsi::select('id','namaprovinsi')->get();
        $kandidats = kandidat::select('id','namakandidat')->get();

        $pemilihs = DB::table('pemilihs')
        ->join('kecamatans', 'pemilihs.id_kecamatan', '=', 'kecamatans.id')
        ->join('kabupatens', 'pemilihs.id_kabupaten', '=', 'kabupatens.id')
        ->join('provinsis', 'kabupatens.id_propinsi', '=', 'provinsis.id')
        ->join('dapils', 'pemilihs.id_dapil', '=', 'dapils.id')
        ->join('kandidats', 'dapils.id_kandidat', '=', 'kandidats.id')
        ->join('timpenggunas', 'pemilihs.id_timpengguna', '=', 'timpenggunas.id') // Added join to table kandidats
        ->select('pemilihs.nama','pemilihs.kontak','pemilihs.jenispilihan','pemilihs.desa',
                 'kecamatans.namakecamatan','kabupatens.namakabupaten','provinsis.namaprovinsi',
                 'kandidats.namakandidat',
                 'timpenggunas.nama as namapengguna')
        ->Where('dapils.jeniskandidat','=','pilgub')->get();
        
        return view('master.pemilih', compact('header','toptitle','pemilihs','provinsi','kandidats'));
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
