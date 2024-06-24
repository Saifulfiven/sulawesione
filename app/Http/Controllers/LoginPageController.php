<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Dapils;

class LoginPageController extends Controller
{
    //
    public function index()
    {
        //$products = Product::latest()->paginate(5);
        //$berita = Berita::latest()->paginate(5);
        //$kegiatan = Kegiatan::latest()->paginate(5);
        $judulconten = "Halaman Login";
        $header = false;
        
        return view('login.signin', compact('judulconten','header'));
    }


    public function authenticate(Request $request)
    {
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required'
        ]);

        $admin = Users::where('email', $request->email)->where('password', $request->password)->first();
        if ($admin) {
            $admin->remember_token = 1;
            $admin->save();
            
            session(['berhasil_login_operator' => true]);
            session(['email'          => $request->email]);
            session(['id_timpengguna' => $admin->id]);
            session(['namapengguna'   => $admin->nama]);
            return redirect('/dashboard');
            
        } else {
            Users::where('email', $request->email)->update(['remember_token' => 0]);

            
        return redirect('loginoperator')->with('error','Terdapat Kesalahan Data, Silahkan Login Kembali');
        }
    }

    public function actionlogout()
    {
        session()->forget('berhasil_login_operator');
        $email = session('email');
        Users::where('email', $email)->update(['remember_token' => 0]);
        session()->flush();
        return redirect('/loginoperator');
    }

    public function login(Request $request)
    {
        $nomorktp = $request->nomorktp;
        $pemilih = Pemilih::where('nomorktp', $nomorktp)->first();
        if ($pemilih) {
            Auth::login($pemilih);
            return redirect('/');
        } else {
            return redirect('/login')->with('error', 'Nomor KTP tidak ditemukan');
        }
    }


    //BAGIAN LOGIN OPERATOR PILKADA PILGUB
    public function admins()
    {
        //$products = Product::latest()->paginate(5);
        //$berita = Berita::latest()->paginate(5);
        //$kegiatan = Kegiatan::latest()->paginate(5);
        $judulconten = "Halaman Login";
        $header = false;
        
        return view('login.adminssignin', compact('judulconten','header'));
    }


    public function adminauthenticate(Request $request)
    {
        $this->validate($request,[
            'username' => 'required',
            'password' => 'required'
        ]);

        $admin = Dapils::where('username', $request->username)->where('password', hash('sha256',$request->password))->first();
        if ($admin) {
            $admin->status_login = 1;
            $admin->save();
            
            session(['berhasil_login_admins' => true]);
            session(['namapengguna'          => $admin->namapengguna]);
            session(['id_dapil'              => $admin->id]);
            session(['id_kabupaten'          => $admin->id_kabupaten]);
            session(['id_provinsi'           => $admin->id_provinsi]);
            session(['jeniskandidat'         => $admin->jeniskandidat]);
            return redirect('/dashboard');
            
        } else {
            Dapils::where('username', $request->username)->update(['status_login' => 0]);

            
        return redirect('login-admins')->with('error','Terdapat Kesalahan Data, Silahkan Login Kembali');
        }
    }

    public function adminsactionlogout()
    {
        session()->forget('berhasil_login_admins');
        $namapengguna = session('namapengguna');
        Dapils::where('namapengguna', $namapengguna)->update(['status_login' => 0]);
        session()->flush();
        return redirect('/login-admins');
    }

}
