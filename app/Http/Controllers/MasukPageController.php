<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timpenggunas;

class MasukPageController extends Controller
{
    
    public function index()
    {
        //$beritas = beritas::find($id);
        $header = false;
        $toptitle = "Login";
        return view('dataform.loginuser', ['toptitle' => $toptitle,'header' => $header]);
    }


    public function authentic(Request $request)
    {
        $this->validate($request,[
            'username' => 'required',
            'password' => 'required'
        ]);

        $admin = Timpenggunas::where('timpenggunas.username', $request->username)
                            ->where('timpenggunas.password', $request->password)
                            ->join('dapils', 'timpenggunas.id_dapil', '=', 'dapils.id')
                            ->select('timpenggunas.id','timpenggunas.nama', 'timpenggunas.jenistim','dapils.jeniskandidat')
                            ->first();
        if ($admin) {
            $admin->remember_token = 1;
            $admin->save();
            
            session(['berhasil_login' => true]);
            session(['username'       => $request->username]);
            session(['id_timpengguna' => $admin->id]);
            session(['namapengguna'   => $admin->nama]);
            session(['jenistim'       => $admin->jenistim]);
            session(['jeniskandidat'  => $admin->jeniskandidat]);
            return redirect('/home');
            
        } else {
            Timpenggunas::where('username', $request->username)->update(['remember_token' => 0]);

            
        return redirect('pengguna/login')->with('error','Terdapat Kesalahan Data, Silahkan Login Kembali');
        }

    }


    public function logout()
    {
        session()->forget('berhasil_login');
        $username = session('username');
        Timpenggunas::where('username', $username)->update(['remember_token' => 0]);
        session()->flush();
        return redirect('/');
    }

}
