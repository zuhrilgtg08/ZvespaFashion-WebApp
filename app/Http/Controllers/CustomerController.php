<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cities;
use App\Models\Provinces;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerController extends Controller
{
    public function pilihKota(string $id)
    {
        $kota = Cities::where('province_id', '=', $id)->select(['id', 'nama_kab_kota'])->get();
        return response()->json($kota);
    }
    
    public function edit(string $email)
    {
        $akun = User::where('roles_type', '=', 0)->where('email', $email)->first();
        $kota = Cities::where('province_id', '=', $akun->u_prov_id)->get();
        $provinsi = Provinces::get(['id', 'name_province']);
        return view('pages.users.data_account.edit_account', compact('akun', 'provinsi', 'kota'));
    }

    public function update(Request $request, string $id)
    {
        if (Auth::user()->roles_type == 0) {
            $validateData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|max:255',
                'u_prov_id' => 'required|max:255',
                'u_kota_id' => 'required|max:155',
                'alamat' => 'string|max:100',
                'job' => 'string|max:150',
                'phone_number' => 'required|numeric|min:12',
                'religion' => 'required|string|max:155',
                'birthday' => 'date|required|string',
                'bio_user' => 'required|string',
                'profile_image' => 'image|max:2048|mimes:jpeg,jpg,svg,png|nullable',
                'roles_type' => 'integer|numeric'
            ]);

            if ($request->file('profile_image')) {
                if ($request->oldImage) {
                    Storage::delete($request->oldImage);
                }
                $validateData['profile_image'] = $request->file('profile_image')->store('foto_kustomer');
            }

            $phone = $request->phone_number;

            if ($phone) {
                $result = sprintf("%s-%s-%s", substr($phone, 0, 4), substr($phone, 4, 4), substr($phone, 8));
                $validateData['phone_number'] = $result;
            }

            $validateData['roles_type'] = 0;

            $validateData['excerpt'] = Str::limit(strip_tags($request->bio_user), 50);

            $account = User::findOrFail($id)->update($validateData);

            if ($account) {
                Alert::toast('This Account has been updated!', 'success')->position('top-end');
                return redirect()->back();
            } else {
                Alert::toast('Sory something when wrong!', 'error')->position('top-end');
                return redirect()->back();
            }
        }
    }

    public function updatePasswordAccount(Request $request, string $id)
    {
        $row = User::findOrFail($id);

        $request->validate([
            'current_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8',
            'confirm_password' => 'required|same:new_password|string|min:8'
        ]);

        if ($row->roles_type == 0) {
            if (Hash::check($request->current_password, $row->password)) {
                if ($request->new_password == $request->confirm_password) {
                    User::find($id)->update([
                        'password' => Hash::make($request->new_password)
                    ]);
                    Alert::toast('Your password Account has been changes!', 'success')->position('top-end');
                    return redirect()->back();
                } else {
                    Alert::toast('Sory something when wrong!', 'error')->position('top-end');
                    return redirect()->back();
                }
            } else {
                Alert::toast('Password is not changes. Please correct again!', 'error')->position('top-end');
                return redirect()->back();
            }
        }
    }

    public function historyOrder()
    {
        return view('pages.users.data_account.listHistory');
    }
}
