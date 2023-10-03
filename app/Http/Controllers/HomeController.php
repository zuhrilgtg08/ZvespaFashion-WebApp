<?php

namespace App\Http\Controllers;

use App\Models\Vespa;
use App\Models\Categories;
use App\Models\Specifications;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $str = '';
        if(request('category')) {
            $category = Categories::firstWhere('slug', request('category'));
            $str = 'Produk Kategori - ' . $category->name_category;
        }

        if(request('specifications')) {
            $specifications = Specifications::firstWhere('type_model', request('specifications'));
            $str = 'Spesifikasi Model - ' . $specifications->type_model;
        }

        return view('pages.root', [
            'str' => $str,
            'vespa' => Vespa::latest()->get(),
            'categories' => Categories::latest()->get(),
            "data" => Vespa::with(['category', 'specifications'])->latest()->filter(request(['cari', 'category', 'specifications']))->paginate(6)->withQueryString(),
        ]);
    }

    public function detail(string $uuid)
    {
        
    }
}
