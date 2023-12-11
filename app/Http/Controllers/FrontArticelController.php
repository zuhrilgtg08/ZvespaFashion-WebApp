<?php

namespace App\Http\Controllers;

use App\Models\Web_Builder\Articel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FrontArticelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Articel::join('users', 'users.id', '=', 'articel_web_builder.user_id')
                            ->join('categories', 'categories.id', '=', 'articel_web_builder.category_id')
                            ->select([
                                'articel_web_builder.id as id',
                                'articel_web_builder.uuid as uuid',
                                'articel_web_builder.title as title_blog',
                                'users.name as name_author',
                                'categories.name_category as category_name',
                            ])->get();

            return DataTables::of($query)
                ->addColumn('action', function ($row) {
                    return '
                            <a href="/articelCompany/' . $row->uuid . '" class="btn btn-primary btn-sm rounded-pill"><i class="fas fa-info-circle"></i> Detail</a>
                        ';
                })
                ->editColumn("uuid", function ($row) {
                    return substr($row->uuid, 24);
                })
                ->rawColumns(['action', 'uuid'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('pages.users.articelCompany');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        $data = Articel::with(['kategori', 'user'])->where('uuid', $uuid)->first();
        $more_blog = Articel::where('user_id', '=', $data->user_id)
                            ->where('uuid', '!=', $uuid)->get();

        return view('pages.users.articelCompany_detail',[
            'data' => $data,
            'more_blog' => $more_blog,
        ]);
    }
}
