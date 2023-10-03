<?php

namespace App\Http\Controllers\Data;
use App\Http\Controllers\Controller;
use App\Models\Web_Builder\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Galeri::get([
                'id',
                'uuid',
                'photos',
            ]);

            return DataTables::of($query)
                ->addColumn('action', function ($row) {
                    return '
                            <a href="/manage_data/web_builder/galeri' . $row->id . '/edit" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                            <form action="http://localhost:3000/manage_data/web_builder/galeri' . $row->id . '" method="POST" class="d-inline">
                                ' . method_field('delete') . csrf_field() . '
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus</button>
                            </form>
                        ';
                })
                ->addColumn('name_file', function($row){
                    return '<h5 class="text-success">'.$row->photos.'</h5>';
                })
                ->editColumn('photos', function ($row) {
                    return asset('storage/' . $row->photos);
                })
                ->editColumn("uuid", function ($row) {
                    return substr($row->uuid, 24);
                })
                ->rawColumns(['action', 'name_file'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('pages.pegawai.galeri.view');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
