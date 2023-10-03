<?php

namespace App\Http\Controllers\Data;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Web_Builder\Profile;

class ProfileController extends Controller
{
    public function form()
    {
        return view('pages.pegawai.profiles.form');
    }

    public function updateProfiles(Request $request)
    {
        $validateData = $request->validate([
            'about' => 'text|nullable|min:155',
            'visi' => 'text|required|min:155',
            'misi' => 'text|required|min:155',
        ]);
    }
}
