<?php

namespace App\Http\Controllers\Data;

use App\Models\Web_Builder\Portofolio;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $query = Portofolio::select(
                'id',
                'title_porto',
                'image_porto',
                'link_porto',
                'year'
            )->get();

            return DataTables::of($query)
                ->addColumn('action', function ($row) {
                    return '
                            <a href="/manage_data/portofolio/' . $row->id . '/edit" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                            <form action="http://localhost:3000/manage_data/portofolio/' . $row->id . '" method="POST" class="d-inline">
                                ' . method_field('delete') . csrf_field() . '
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus</button>
                            </form>
                        ';
                })
                ->editColumn('image_porto', function ($row) {
                    return asset('storage/' . $row->image_porto);
                })
                ->editColumn('link_porto', function ($row) {
                    return '<a href="#" class="text-primary d-inline underline">' . $row->link_porto . '</a>';
                })
                ->rawColumns(['action', 'link_porto', 'image_porto'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('pages.pegawai.portofolio.view');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.pegawai.portofolio.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title_porto' => 'required|string|max:255',
            'slug' => 'required|string',
            'description' => 'string|required',
            'image_porto' => 'nullable|image|file|mimes:jpg,png,svg,jpeg|max:2048',
            'link_porto' => 'required|string',
            'year' => 'required|integer|min:1',
        ]);

        if($request->file('image_porto')) {
            $validateData['image_porto'] = $request->file('image_porto')->store('projek_portofolio');
        }

        $data = Portofolio::create($validateData);

        if ($data) {
            Alert::toast('New Project Portofolio has been created!', 'success')->position('top-end');
            return redirect()->route('karyawan.portofolio.index');
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
        $row = Portofolio::findOrFail($id);
        return view('pages.pegawai.portofolio.form', ['row' => $row]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'title_porto' => 'required|string|max:255',
            'slug' => 'required|string',
            'description' => 'string|required',
            'image_porto' => 'nullable|image|file|mimes:jpg,png,svg,jpeg|max:2048',
            'link_porto' => 'required|string',
            'year' => 'required|integer|min:1',
        ]);

        if($request->file('image_porto')) {
            if($request->oldImage_porto) {
                Storage::delete($request->oldImage_porto);
            }
            $validateData['image_porto'] = $request->file('image_porto')->store('projek_portofolio');
        }

        $row = Portofolio::findOrFail($id)->update($validateData);

        if ($row) {
            Alert::toast('This Project Portofolio has been updated!', 'success')->position('top-end');
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
        $data = Portofolio::findOrFail($id);

        if ($data->image_porto) {
            Storage::delete($data->image_porto);
        }

        $data->destroy($id);
        Alert::toast('This project has been deleted!', 'success')->position('top-end');
        return redirect()->route('karyawan.portofolio.index');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Portofolio::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
