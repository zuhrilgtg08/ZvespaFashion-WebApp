<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('pages.users.auth.register');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|unique:users|max:255',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'create_password' => 'required|min:8',
            'password' => 'required|same:create_password|min:8',
        ]);

        $validate['password'] = Hash::make($validate['password']);

        $data = User::create($validate);

        if ($data) {
            Alert::toast('Register Success! Please login, now', 'success')->position('top-end');
            return redirect()->route('login');
        } else {
            Alert::toast('Something Wrong! Please correct again', 'error')->position('top-end');
            return redirect()->back();
        }
    }

}
