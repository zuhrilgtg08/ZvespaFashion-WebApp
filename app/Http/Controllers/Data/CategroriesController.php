<?php

namespace App\Http\Controllers\Data;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class CategroriesController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            $query = Categories::query();
            return DataTables::of($query)
                       ->addIndexColumn()
                       ->addColumn('action', function($row){
                            return '
                                <a href="' . route('admin.kategori.edit', $row->id) . '" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                <form action="' . route('admin.kategori.destroy', $row->id) . '" method="POST" class="d-inline">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                                    <button type="submit" class="btn btn-danger btn-sm" data-confirm-delete="true"><i class="fas fa-trash-alt"></i> Hapus</button>
                                </form>
                            ';
                       })
                       ->rawColumns(['action'])
                       ->make(true);
        }
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('pages.admin.dataKategori.view');
    }
}
