<?php

namespace App\Http\Controllers\Data;
use App\Models\Vespa;
use App\Models\Categories;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class VespaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $query = Vespa::select(
                            'products_vespa.id as id',
                            'products_vespa.uuid as kode_produk',
                            'products_vespa.name_product as nama_produk',
                            'products_vespa.nomor_seri as nomor_seri',
                            'products_vespa.stock_product as stok',
                            'products_vespa.harga_product as harga',
                          )->get();
                
            return DataTables::of($query)
                ->addColumn('action', function ($row) {
                    return '
                            <a href="/manage_dashboard/vespa/' . $row->id . '/edit" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                            <a href="/manage_dashboard/vespa/' . $row->kode_produk . '" class="btn btn-primary btn-sm"><i class="fas fa-info-circle"></i> Detail</a>
                            <form action="http://localhost:3000/manage_dashboard/vespa/' . $row->id . '" method="POST" class="d-inline">
                                ' . method_field('delete') . csrf_field() . '
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus</button>
                            </form>
                        ';
                })
                ->editColumn("kode_produk", function ($row) {
                    return substr($row->kode_produk, 24);
                })
                ->editColumn("harga", function ($row) {
                    return 'Rp ' . number_format($row->harga) . '';
                })
                ->rawColumns(['action', 'harga'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('pages.admin.dataVespa.view');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Categories::get(['id', 'name_category']);
        return view('pages.admin.dataVespa.form', ['kategori' => $kategori]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name_product' => 'required|string|max:255',
            'stock_product' => 'required|integer|numeric|min:1',
            'nomor_seri' => 'required|string|max:100',
            'launch_year' => 'required|integer|numeric|min:1',
            'category_id' => 'required|max:100',
            'harga_product' => 'required|integer|numeric|min:1000',
            'photo_product' => 'nullable|array',
            'thumbnail' => 'nullable|image|file|max:2048|mimes:jpeg,jpg,png,svg',
            'detail_product' => 'required|string',
            "engine" => "required|string|max:150",
            "displacement" => "required|string|max:150",
            "max_power" => "required|string|max:150",
            "max_torque" => "required|string|max:150",
            "colling_system" => "required|string|max:150",
            "transmission" => "required|string|max:150",
            "brake_system" => "required|string|max:150",
            "front_tire" => "required|string|max:150",
            "rear_tire" => "required|string|max:150",
            "type_model" => "required|string|max:150",
            "fuel_capacity" => "required|string|max:150",
            "weight_product" => "required|numeric|integer|min:1",
        ]);

        $validateData['excerpt'] = Str::limit(strip_tags($request->detail_product), 50);

        $foto_produk = $request->file('photo_product');
        $empty_foto = [];

        foreach($foto_produk as $dtImg) {
            $path = $dtImg->store('photo_product', 'public');
            array_push($empty_foto, $path);
        }

        $validateData['photo_product'] = $empty_foto;

        if ($request->file('thumbnail')) {
            $validateData['thumbnail'] = $request->file('thumbnail')->store('thumbnail-vespa');
        }

        $data = Vespa::create($validateData);
        
        if($data) {
            Alert::toast('New Product has been created!', 'success')->position('top-end');
            return redirect()->route('admin.vespa.index');
        } else {
            Alert::toast('Sory something when wrong!', 'error')->position('top-end');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        $row = Vespa::where('uuid', $uuid)->first();
        return view('pages.admin.dataVespa.detail', ['row' => $row]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $row = Vespa::findOrFail($id);
        $kategori = Categories::get(['id', 'name_category']);
        return view('pages.admin.dataVespa.form', [
            'row' => $row,
            'kategori' => $kategori,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $datas = [
            'name_product' => 'required|string|max:255',
            'stock_product' => 'required|integer|numeric|min:1',
            'nomor_seri' => 'required|string|max:100',
            'launch_year' => 'required|integer|numeric|min:1',
            'category_id' => 'required|max:100',
            'harga_product' => 'required|integer|numeric|min:1000',
            'photo_product' => 'nullable|array',
            'thumbnail' => 'nullable|image|file|max:2048|mimes:jpeg,jpg,png,svg',
            'detail_product' => 'required|string',
            "engine" => "required|string|max:150",
            "displacement" => "required|string|max:150",
            "max_power" => "required|string|max:150",
            "max_torque" => "required|string|max:150",
            "colling_system" => "required|string|max:150",
            "transmission" => "required|string|max:150",
            "brake_system" => "required|string|max:150",
            "front_tire" => "required|string|max:150",
            "rear_tire" => "required|string|max:150",
            "type_model" => "required|string|max:150",
            "fuel_capacity" => "required|string|max:150",
            "weight_product" => "required|numeric|integer|min:1",
        ];

        $validateData = $request->validate($datas);

        $validateData['excerpt'] = Str::limit(strip_tags($request->detail_product), 50);

        if ($request->file('thumbnail')) {
            if ($request->oldImage_thumbnail) {
                Storage::delete($request->oldImage_thumbnail);
            }
            $validateData['thumbnail'] = $request->file('thumbnail')->store('thumbnail-vespa');
        }

        if($request->file('photo_product')) {
            $newImg =[];
            if($request->old_photo_product) {
                Storage::delete($request->old_photo_product);
            }
            foreach($request->file('photo_product') as $data) {
                $path = $data->store('photo_product', 'public');
                $newImg[] = $path;
            }
            $validateData['photo_product'] = $newImg;
        }

        $row = Vespa::find($id)->update($validateData);

        if ($row) {
            Alert::toast('This Product has been updated!', 'success')->position('top-end');
            return redirect()->route('admin.vespa.edit', $id);
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
        $data = Vespa::findOrFail($id);

        if($data->thumbnail && $data->photo_product) {
            Storage::delete($data->thumbnail);
            Storage::delete($data->photo_product);
        }

        $data->destroy($id);
        Alert::toast('This Product has been deleted!', 'success')->position('top-end');
        return redirect()->route('admin.vespa.index');
    }
}
