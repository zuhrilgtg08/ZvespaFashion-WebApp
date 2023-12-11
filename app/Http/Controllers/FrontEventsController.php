<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Models\Web_Builder\Events;
use Illuminate\Support\Carbon;
use App\Models\Web_Builder\Portofolio;

class FrontEventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.users.eventsCompany', [
            'datas' => Events::get(),
            'paginate' => Events::paginate(9)->withQueryString(),
        ]);
    }

    public function show(string $slug) 
    {   
        $row = Events::where('slug', '=', $slug)->first();
        return view('pages.users.eventsCompany_detail', ['row' => $row]);
    }
}
