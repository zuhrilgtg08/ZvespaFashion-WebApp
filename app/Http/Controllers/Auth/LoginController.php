<?php

namespace App\Http\Controllers\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.users.auth.login');
    }

    public function authenticate(Request $request)
    {
        $validate = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt($validate)) {
            $request->session()->regenerate();

            if (Auth::user()->roles_type == 1) {
                return redirect()->intended('/admin/manage_dashboard');
            } else if(Auth::user()->roles_type == 2) {
                return redirect()->intended('/karyawan/manage_data');
            } else {
                return redirect()->intended('/home');
            }
        }

        Alert::toast('Access denied! Something when wrong', 'error')->position('top-end');
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
