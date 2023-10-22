<?php

namespace App\Http\Controllers\Data;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\Web_Builder\Articel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class ArticelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Articel::join('users as creator', 'creator.id', '=', 'articel_web_builder.user_id')
                            ->join('categories', 'categories.id', '=', 'articel_web_builder.category_id')
                            ->where('user_id', '=', Auth::user()->id)
                            ->select([
                                'articel_web_builder.id as id',
                                'articel_web_builder.title as title_blog',
                                'creator.name as creator_name',
                                'categories.name_category as category',
                            ])->get();

            return DataTables::of($query)
                ->addColumn('action', function ($row) {
                    return '
                            <a href="/manage_data/articel/' . $row->id . '/edit" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                            <form action="http://localhost:3000/manage_data/articel/' . $row->id . '" method="POST" class="d-inline">
                                ' . method_field('delete') . csrf_field() . '
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus</button>
                            </form>
                        ';
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('pages.pegawai.articel.view');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Categories::select('id', 'name_category')->get();
        return view('pages.pegawai.articel.form', ['kategori' => $kategori]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|string',
            'category_id' => 'required',
            'slug' => 'required|string',
            'user_id' => 'required|max:155',
            'content' => 'required|string',
            'photo_articel' => 'nullable|array',
            'thumbnail' => 'nullable|mimes:png,jpeg,jpg,svg|max:2048|file|image',
        ]);

        $foto_artikel = $request->file('photo_articel');
        $empty_foto = [];

        foreach ($foto_artikel as $dtImg) {
            $path = $dtImg->store('photo_artikel', 'public');
            array_push($empty_foto, $path);
        }

        $validateData['photo_articel'] = $empty_foto;

        if($request->file('thumbnail')) {
            $validateData['thumbnail'] = $request->file('thumbnail')->store('thumbnail-artikel');
        }

        $validateData['user_id'] = Auth::user()->id;

        $data = Articel::create($validateData);

        if ($data) {
            Alert::toast('New articel has been created!', 'success')->position('top-end');
            return redirect()->route('karyawan.articel.index');
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
        $row = Articel::findOrFail($id);
        $kategori = Categories::select('id', 'name_category')->get();
        return view('pages.pegawai.articel.form', [
            'kategori' => $kategori,
            'row' => $row,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'title' => 'required|string',
            'category_id' => 'required',
            'slug' => 'required|string',
            'user_id' => 'required|max:155',
            'content' => 'required|string',
            'photo_articel' => 'nullable|array',
            'thumbnail' => 'nullable|mimes:png,jpeg,jpg,svg|max:2048|file|image',
        ]);

        if ($request->file('thumbnail')) {
            if ($request->oldImage_thumbnail) {
                Storage::delete($request->oldImage_thumbnail);
            }
            $validateData['thumbnail'] = $request->file('thumbnail')->store('thumbnail-artikel');
        }

        if ($request->file('photo_articel')) {
            $newImg = [];
            if ($request->old_photo_articel) {
                Storage::delete($request->old_photo_articel);
            }
            foreach ($request->file('photo_articel') as $data) {
                $path = $data->store('photo_artikel', 'public');
                $newImg[] = $path;
            }
            $validateData['photo_articel'] = $newImg;
        }

        $row = Articel::findOrFail($id)->update($validateData);

        if ($row) {
            Alert::toast('This articel has been updated!', 'success')->position('top-end');
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
        $data = Articel::findOrFail($id);

        if ($data->thumbnail && $data->photo_articel) {
            Storage::delete($data->thumbnail);
            Storage::delete($data->photo_articel);
        }

        $data->destroy($id);
        Alert::toast('This your articel has been deleted!', 'success')->position('top-end');
        return redirect()->route('karyawan.articel.index');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Articel::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
