<?php

namespace App\Http\Controllers;
use App\Models\Web_Builder\Portofolio;
use Illuminate\Http\Request;

class FrontPortofolioController extends Controller
{
    public function index()
    {
        $datas = Portofolio::paginate(9)->withQueryString();
        return view('pages.users.portofolioCompany', compact('datas'));
    }

    public function show(string $slug)
    {
        $row = Portofolio::where('slug', $slug)->first();
        return view('pages.users.portofolioCompany_detail', compact('row'));
    }
}
