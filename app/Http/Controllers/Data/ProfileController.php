<?php

namespace App\Http\Controllers\Data;
use Illuminate\Http\Request;
use App\Models\Web_Builder\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function form(string $id)
    {
        $row = Profile::where('karyawan_id', '=', $id)->first();
        return view('pages.pegawai.profiles.form', ['row' => $row]);
    }

    public function store(Request $request) {
        $validateData = $request->validate([
            'karyawan_id' => 'required',
            'about' => 'string|nullable',
            'visi' => 'string|required',
            'misi' => 'string|required',
        ]);

        $data = Profile::create($validateData);

        if ($data) {
            Alert::toast('This Content has been new created!', 'success')->position('top-end');
            return redirect()->route('karyawan.profile.form', auth()->user()->id);
        } else {
            Alert::toast('Sory something when wrong!', 'error')->position('top-end');
            return redirect()->back();
        }
    }

    public function updateProfiles(Request $request, string $id)
    {
        $validateData = $request->validate([
            'karyawan_id' => 'required',
            'about' => 'string|nullable',
            'visi' => 'string|required',
            'misi' => 'string|required',
        ]);

        $validateData['karyawan_id'] = Auth::user()->id;

        $data = Profile::where('karyawan_id', $id)->update($validateData);

        if ($data) {
            Alert::toast('This Content has been up to date!', 'success')->position('top-end');
            return redirect()->route('karyawan.profile.form', auth()->user()->id);
        } else {
            Alert::toast('Sory something when wrong!', 'error')->position('top-end');
            return redirect()->back();
        }
    }
}
