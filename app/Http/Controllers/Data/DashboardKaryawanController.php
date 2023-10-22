<?php

namespace App\Http\Controllers\Data;
use App\Http\Controllers\Controller;
use App\Models\Web_Builder\Articel;
use App\Models\Web_Builder\Events;
use App\Models\Web_Builder\Galeri;
use App\Models\Web_Builder\Portofolio;
use Illuminate\Http\Request;

class DashboardKaryawanController extends Controller
{
    public function index()
    {
        $data_p = [
            'artikel' => Articel::get()->count(),
            'portofolio' => Portofolio::get()->count(),
            'events' => Events::get()->count(),
            'galeri' => Galeri::get()->count(),
        ];

        return view('pages.pegawai.index', [
            'data_p' => $data_p,
        ]);
    }
}
