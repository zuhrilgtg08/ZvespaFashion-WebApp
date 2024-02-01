<?php

namespace App\Http\Controllers\Data;
use App\Models\User;
use App\Models\Vespa;
use App\Models\Checkout;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'customer' => User::where('roles_type', '=', 0)->count(),
            'karyawan' => User::where('roles_type', '=', 2)->count(),
            'kategori' => Categories::latest()->count(),
            'model_vespa' => Vespa::latest()->count(),
            'total_stock_vespa' => Vespa::sum('stock_product'),
            'order' => Checkout::select(['harga_ongkir', 'total_amount'])->get(),
            'checkout' => Checkout::where('transaction_status', '=', 'settlement')->count()
        ];

        $dataOrder = $data['order']->toArray();

        $datas = [
            'order_0' => $dataOrder[0]['harga_ongkir'] + $dataOrder[0]['total_amount'] + 5000,
            'order_1' => $dataOrder[1]['harga_ongkir'] + $dataOrder[1]['total_amount'] + 5000,
            'order_2' => $dataOrder[2]['harga_ongkir'] + $dataOrder[2]['total_amount'] + 5000,
            'order_3' => $dataOrder[3]['harga_ongkir'] + $dataOrder[3]['total_amount'] + 5000,
        ];

        $total = 0;

        foreach($data['order'] as $dt) {
            $total += $dt->harga_ongkir + $dt->total_amount + 5000;
        }

        return view('pages.admin.index', [
            'data' => $data,
            'datas' => $datas,
            'total' => $total,
        ]);
    }

    public function setting(string $email)
    {
        $row = User::where('roles_type', '=', 1)->where('email', $email)->first();
        return view('pages.setting', [
            'row' => $row,
            'trig' => 'setting-akun',
        ]);
    }

    public function updateData(Request $request, string $id)
    {
        if(Auth::user()->roles_type == 1) {
            $validateData = $request->validate([
                'name' => 'required|string|max:155',
                'email' => 'required|string|email|max:155',
                'job' => 'string|required',
                'phone_number' => 'numeric|required|min:12',
                'alamat' => 'string|required|max:100',
                'birthday' => 'date|string',
                'profile_image' => 'nullable|image|file|max:2048|mimes:jpg,png,svg,jpeg'
            ]);
    
            if($request->file('profile_image')) {
                if($request->oldImage) {
                    Storage::delete($request->oldImage);
                }
                $validateData['profile_image'] = $request->file('profile_image')->store('admin-profile');
            }
    
            $phone = $request->phone_number;
            if ($phone) {
                $result = sprintf("%s-%s-%s", substr($phone, 0, 4), substr($phone, 4, 4), substr($phone, 8));
                $validateData['phone_number'] = $result;
            }
    
            $data = User::findOrFail($id)->update($validateData);

            if ($data) {
                Alert::toast('Account has been updated!', 'success')->position('top-end');
                return redirect()->back();
            } else {
                Alert::toast('Sory something when wrong!', 'error')->position('top-end');
                return redirect()->back();
            }
        }
    }

    public function updatePassword(Request $request, string $id)
    {
        $row = User::findOrFail($id);

        $request->validate([
            'current_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8',
            'confirm_password' => 'required|same:new_password|string|min:8'
        ]);

        if ($row->roles_type == 1) {
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
}
