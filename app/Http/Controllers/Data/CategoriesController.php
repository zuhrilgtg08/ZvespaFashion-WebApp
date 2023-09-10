<?php

namespace App\Http\Controllers\Data;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class CategoriesController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            $query = Categories::query();
            return DataTables::of($query)
                       ->addColumn('action', function($row){
                            return '
                                <a href="/manage_dashboard/kategori/'. $row->id . '/edit" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                <form action="http://localhost:3000/manage_dashboard/kategori/'. $row->id . '" method="POST" class="d-inline">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus</button>
                                </form>
                            ';
                       })
                       ->rawColumns(['action'])
                       ->addIndexColumn()
                       ->make(true);
        }

        return view('pages.admin.dataKategori.view');
    }

    public function create()
    {
        return view('pages.admin.dataKategori.form');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name_category' => 'required|string|max:155|unique:categories',
            'slug' => 'required|string|max:155',
        ]);

        $data = Categories::create($validateData);

        if($data) {
            Alert::toast('Category has been created!', 'success')->position('top-end');
            return redirect()->route('admin.kategori.index');
        } else {
            Alert::error('Data Category', 'Category not created!')->position('top-end');
            return redirect()->back();
        }
    }

    public function edit(string $id) 
    {
        $row = Categories::findOrFail($id);
        return view('pages.admin.dataKategori.form', ['row' => $row]);
    }

    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'name_category' => 'required|string|max:155',
            'slug' => 'required|string|max:155',
        ]);

        $data = Categories::findOrFail($id)->update($validateData);

        if($data) {
            Alert::toast('Category has been updated!', 'success')->position('top-end');
            return redirect()->route('admin.kategori.edit', $id);
        } else {
            Alert::toast('Category not updated!', 'error')->position('top-end');
            return redirect()->route('admin.kategori.edit', $id);
        }
    }

    public function destroy(string $id)
    {
        $kategori = Categories::findOrFail($id);
        $kategori->delete();
        Alert::toast('Category has been deleted!', 'info')->position('top-end');
        return redirect()->route('admin.kategori.index');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Categories::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
