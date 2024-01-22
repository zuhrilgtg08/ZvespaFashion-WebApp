<?php

namespace App\Http\Controllers\Auth;
use Throwable;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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

    public function reset()
    {
        return view('pages.users.auth.reset');
    }

    public function resetPassword(Request $request)
    {
        $cek_email_user = User::where('email', $request->reset_email)->select(['id', 'email', 'password'])->first();

        $validate = $request->validate([
            'reset_email' => ['required', 'string', 'email', 'max:255'],
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password|min:8' 
        ]);

        $validate['confirm_password'] = $request->confirm_password;

            try {
                if ($cek_email_user->id == NUll) {
                    Alert::toast('Something Wrong! Please correct again', 'error')->position('top-end');
                    return redirect()->back();
                } else {
                    if ($request->new_password == $request->confirm_password || $cek_email_user->email != NULL) {
                        User::where('id', '=', $cek_email_user->id)->update([
                            'password' => bcrypt($validate['confirm_password']),
                        ]);

                        Alert::toast('Reset success! Please login again', 'success')->position('top-end');
                        return redirect()->route('login');
                    }
                }
            } catch (Throwable $err) {
                Alert::toast('Something Wrong! Please correct again', 'error')->position('top-end');
                return redirect()->back();
            } 
}

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
