<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    //use AuthenticatesUsers;

    protected $maxAttempts = 13;
    protected $decayMinutes = 2;

    public function __construct()
    {
        $this->middleware('guest:admin')->except('postLogout');
    }

    public function getLogin()
    {
        
        $toptitle = "SULAWESIONE :. Data Form";
        $header = false;
        return view('dataform.loginuser', compact('header','toptitle'));
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:7'
        ]);

        if (auth()->guard('admin')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);
            return redirect()->intended();
        } else {
            $this->incrementLoginAttempts($request);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors(["Incorrect user login details!"]);
        }
    }

    public function postLogout()
    {
        auth()->guard('admin')->logout();
        session()->flush();

        return redirect()->route('pengguna.login');
    }
}
