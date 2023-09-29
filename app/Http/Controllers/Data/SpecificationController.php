<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\Specifications;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Vespa;

use Illuminate\Http\Request;

class SpecificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Specifications::join('products_vespa as vespa', 'vespa.id', '=', 'specifications.product_id')
                ->select([
                    'specifications.id as id',
                    'vespa.name_product as nama_vespa',
                    'vespa.harga_product as harga_vespa',
                    'specifications.uuid as code',
                    'specifications.engine as engine',
                ])->get();

            return DataTables::of($query)
                ->addColumn('action', function ($row) {
                    return '
                            <a href="/manage_dashboard/spesifikasi/' . $row->id . '/edit" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                            <a href="/manage_dashboard/spesifikasi/' . $row->code . '" class="btn btn-primary btn-sm"><i class="fas fa-info-circle"></i> Detail</a>
                            <form action="http://localhost:3000/manage_dashboard/spesifikasi/' . $row->id . '" method="POST" class="d-inline">
                                ' . method_field('delete') . csrf_field() . '
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus</button>
                            </form>
                        ';
                })
                ->editColumn("code", function ($row) {
                    return substr($row->code, 24);
                })
                ->editColumn("harga_vespa", function ($row) {
                    return 'Rp ' . number_format($row->harga_vespa) . '';
                })
                ->rawColumns(['action', 'harga'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('pages.admin.dataSpesifikasi.view');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vespa = Vespa::get(['id', 'name_product']);
        return view('pages.admin.dataSpesifikasi.form', ['vespa' => $vespa]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            "product_id" => "required|integer",
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
        ]);

        $data = Specifications::create($validateData);

        if ($data) {
            Alert::toast('New vespa specifications has been created!', 'success')->position('top-end');
            return redirect()->route('admin.spesifikasi.index');
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
        $row = Specifications::where('uuid', '=', $uuid)->first();
        return view('pages.admin.dataSpesifikasi.detail', ['row' => $row]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vespa = Vespa::get(['id', 'name_product']);
        $row = Specifications::findOrFail($id);
        return view('pages.admin.dataSpesifikasi.form', [
            'vespa' => $vespa,
            'row' => $row,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            "product_id" => "required|integer",
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
        ]);

        $data = Specifications::find($id)->update($validateData);

        if ($data) {
            Alert::toast('This vespa specifications has been updated!', 'success')->position('top-end');
            return redirect()->route('admin.spesifikasi.edit', $id);
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
        Specifications::find($id)->delete();
        Alert::toast('This vespa specifications has been deleted!', 'success')->position('top-end');
        return redirect()->route('admin.spesifikasi.index');
    }
}
