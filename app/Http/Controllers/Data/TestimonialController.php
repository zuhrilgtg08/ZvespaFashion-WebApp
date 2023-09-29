<?php

namespace App\Http\Controllers\Data;
use App\Models\User;
use App\Models\Vespa;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $query = Testimonial::join('products_vespa as vespa', 'vespa.id', '=', 'testimonial.product_id')
                                ->join('users', 'users.id', '=', 'testimonial.user_id')
                                ->select([
                                    'users.email as email_cs',
                                    'testimonial.rate as nilai_rating',
                                    'testimonial.product_id as productId',
                                    'vespa.name_product as nama_vespa',
                                    'vespa.harga_product as harga_vespa',
                                    'vespa.uuid as kode',
                                    'testimonial.id as id',
                                ])->get();

            return DataTables::of($query)
                ->addColumn('action', function ($row) {
                    return '
                            <a href="/manage_dashboard/source/testimoni/detail/' . $row->kode . '" class="btn btn-primary btn-sm"><i class="fas fa-info-circle"></i> Detail</a>
                            <form action="http://localhost:3000/manage_dashboard/source/testimoni/destroy/' . $row->id . '" method="POST" class="d-inline">
                                ' . method_field('delete') . csrf_field() . '
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus</button>
                            </form>
                        ';
                })
                ->editColumn("harga_vespa", function ($row) {
                    return 'Rp ' . number_format($row->harga_vespa) . '';
                })
                ->editColumn('nilai_rating', function($row) {
                    $dataRatings = Testimonial::where('product_id', '=', $row->productId)->get();

                    if ($dataRatings->count() == 0) {
                        return $row->nilai_rating = 0;
                    } else {
                        $rating = $dataRatings->sum('rate') / $dataRatings->count();
                        $row->nilai_rating = $rating;
                        return $row->nilai_rating;
                    }
                })
                ->rawColumns(['action', 'harga'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('pages.admin.dataTestimonial.view');
    }

    public function detail(string $uuid)
    {
        $data = Testimonial::join('products_vespa as vespa', 'vespa.id', '=', 'testimonial.product_id')
                           ->join('users', 'users.id', '=', 'testimonial.user_id')
                           ->where('vespa.uuid', '=', $uuid)
                           ->get([
                                'vespa.name_product as nama_vespa',
                                'vespa.harga_product as harga_vespa',
                                'vespa.launch_year as year',
                                'users.email as email',
                                'users.name as name_user',
                                'users.profile_image as profile',
                                'testimonial.*',
                           ]);
    
        return view('pages.admin.dataTestimonial.detail', ['data' => $data]);
    }

    public function destroy(string $id)
    {
        $data = Testimonial::findOrFail($id);
        $data->delete();
        Alert::toast('This Review data has been deleted!', 'success')->position('top-end');
        return redirect()->route('admin.testimoni.index');
    }
}
