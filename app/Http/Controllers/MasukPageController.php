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
        $toptitle = "SulawesiOne :. Login";
        return view('dataform.loginuser', ['toptitle' => $toptitle,'header' => $header]);
    }


    public function authentic(Request $request)
    {
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required'
        ]);

        $admin = Timpenggunas::where('email', $request->email)->where('password', $request->password)->first();
        if ($admin) {
            $admin->remember_token = 1;
            $admin->save();
            
            session(['berhasil_login' => true]);
            session(['email'          => $request->email]);
            session(['id_timpengguna' => $admin->id]);
            session(['namapengguna'   => $admin->nama]);
            return redirect('/home');
            
        } else {
            Timpenggunas::where('email', $request->email)->update(['remember_token' => 0]);

            
        return redirect('pengguna/login')->with('error','Terdapat Kesalahan Data, Silahkan Login Kembali');
        }

    }


    public function logout()
    {
        session()->forget('berhasil_login');
        $email = session('email');
        Timpenggunas::where('email', $email)->update(['remember_token' => 0]);
        session()->flush();
        return redirect('/');
    }

}
