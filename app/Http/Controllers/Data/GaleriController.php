<?php

namespace App\Http\Controllers\Data;
use App\Models\Vespa;
use Illuminate\Http\Request;
use App\Models\Web_Builder\Galeri;
use App\Http\Controllers\Controller;
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
                            <a href="/manage_data/web_builder/galeri/' . $row->id . '/edit" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                            <form action="http://localhost:3000/manage_data/web_builder/galeri/' . $row->id . '" method="POST" class="d-inline">
                                ' . method_field('delete') . csrf_field() . '
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus</button>
                            </form>
                        ';
                })
                ->addColumn('name_file', function($row){
                    return '<div class="text-success d-inline">'.$row->photos.'</d>';
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
        $vespa = Vespa::latest()->get();
        return view('pages.pegawai.galeri.form', ['vespa' => $vespa]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'product_id' => 'required',
            'photos' => 'image|file|max:2048|mimes:jpg,jpeg,png,svg',
        ]);

        if($request->file('photos')){
            $validate['photos'] = $request->file('photos')->store('Galeri-content');
        }

        $data = Galeri::create($validate);

        if ($data) {
            Alert::toast('New Photo Content has been created!', 'success')->position('top-end');
            return redirect()->route('karyawan.galeri.index');
        } else {
            Alert::toast('Sory something when wrong!', 'error')->position('top-end');
            return redirect()->back();
        }
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
        $row = Galeri::findOrFail($id);
        $vespa = Vespa::latest()->get();
        return view('pages.pegawai.galeri.form', [
            'row' => $row,
            'vespa' => $vespa,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'product_id' => 'required',
            'photos' => 'image|file|max:2048|mimes:jpg,jpeg,png,svg',
        ]);

        if ($request->file('photos')) {
            if($request->oldPhotos) {
                Storage::delete($request->oldPhotos);
            }
            $validate['photos'] = $request->file('photos')->store('Galeri-content');
        }

        $data = Galeri::find($id)->update($validate);

        if ($data) {
            Alert::toast('This Photo has been updated!', 'success')->position('top-end');
            return redirect()->back();
        } else {
            Alert::toast('Sory something when wrong!', 'error')->position('top-end');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Galeri::findOrFail($id);

        if ($data->photos) {
            Storage::delete($data->photos);
        }

        $data->destroy($id);
        Alert::toast('This photo has been deleted!', 'success')->position('top-end');
        return redirect()->route('karyawan.galeri.index');
    }
}
