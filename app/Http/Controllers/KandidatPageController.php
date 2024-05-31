<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kandidat;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\DB; // Import DB class
// Function to delete a file or photo


class KandidatPageController extends Controller
{
    

    //Dashboard

    public function index()
    {
        $toptitle = "SulawesiOne :. Dashboard - kandidat";
        $header = false;
        $kandidat = kandidat::latest()->paginate(5);

        return view('kandidat.tabel', compact('header','toptitle','kandidat'));
    }

    public function tambah()
    {
        $toptitle = "SulawesiOne :. Tambah Data Kandidat";
        $header = false;
        return view('kandidat.tambah', compact('header','toptitle'));
     }


    public function simpan(Request $request)
    {
        $this->validate($request,[
            'namakandidat' => 'required',
            'foto' => 'required|image|mimes:jpeg,jpg,png'
        ]);
        
        //upload foto
        $foto = $request->foto;
        $namafile = time()."_".$foto->getClientOriginalName();
        $tujuan_upload = 'images/kandidat';
        $foto->move($tujuan_upload,$namafile);

        $namakandidatnya = $request->namakandidat;
        //SlugService::createSlug(Post::class, 'slug', $post->title);

        kandidat::create([
            'namakandidat' => $request->namakandidat,
            'foto' => $namafile
        ]);

        if($foto){
            return redirect('admin/kandidat')->with('success','Data Kandidat berhasil disimpan');
        }
        else{
            return redirect()->back()->withInput()->withErrors($request->all())->with('error','Data gagal disimpan, cek kembali form anda');
        }
    }

    
    public function ubah($id)
    {
        $kandidat = kandidat::find($id);
        $toptitle = "SulawesiOne :. Ubah Data kandidat";
        return view('kandidat.ubah', ['dataubah' => $kandidat,'toptitle' => $toptitle]);
    }


    public function update(Request $request)
    {
        $this->validate($request,[
            'namakandidat' => 'required',
            'foto' => 'image|mimes:jpeg,jpg,png'
        ]);

        $id = $request->id;
        $kandidat = kandidat::find($id);
        $foto = $request->foto;
        if($foto){
            $namafile = time()."_".$foto->getClientOriginalName();
            $tujuan_upload = 'images/kandidat';
            $foto->move($tujuan_upload,$namafile);
        }
        else{
            $namafile = $kandidat->foto;
        }

        kandidat::whereId($id)->update([
            'namakandidat' => $request->namakandidat,
            'foto' => $namafile
        ]);

        return redirect('admin/kandidat')->with('success','Data Kandidat berhasil diubah');
    }


    public function hapus($id)
    {
        $kandidat = kandidat::find($id);
        $namafile = $kandidat->foto;

        if($kandidat->delete()){
            unlink(public_path('images/kandidat/'.$namafile));
            //File::delete('/images/kandidat/'.$namafile);
        
            return redirect('admin/kandidat')->with('success','Data berhasil dihapus');
        }
        else{
            return redirect('admin/kandidat')->with('error','Data gagal dihapus');
        }
    }
    public function hapusFile($filePath)
    {
        if(File::exists($filePath)) {
            File::delete($filePath);
            return "File successfully deleted";
        } else {
            return "File not found";
        }
    }

}
