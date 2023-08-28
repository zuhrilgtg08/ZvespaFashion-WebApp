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
        return view('pages.root', [
            'categories' => Categories::get(),
            'vespa' => Vespa::get(),
            'specifications' => Specifications::get(),
        ]);
    }
}
