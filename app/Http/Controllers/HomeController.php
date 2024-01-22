<?php

namespace App\Http\Controllers;

use App\Models\Vespa;
use App\Models\Categories;
use App\Models\Testimonial;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index()
    {
        $str = '';
        if(request('category')) {
            $category = Categories::firstWhere('slug', request('category'));
            $str = 'Produk Kategori - ' . $category->name_category;
        }

        return view('pages.root', [
            'str' => $str,
            'vespa' => Vespa::latest()->get(),
            'categories' => Categories::latest()->get(),
            "data" => Vespa::with(['category'])->latest()->filter(request(['cari', 'category']))->paginate(6)->withQueryString(),
        ]);
    }

    public function detail(string $uuid)
    {
        $row = Vespa::with(['testimoni'])->where('uuid', $uuid)->first();
        $all_rev = 0;
        if($row->testimoni->count() == 0) {
            $row->testimoni->rate = 0;
        } else {
            $all_rev = $row->testimoni->sum('rate') / $row->testimoni->count();
        }

        $reviews = Testimonial::with('vespa')->where([
            ['product_id', '=', $row->id],
            ['user_id', '=', Auth::user()->id],
        ])->get();

        $desc_short = Str::limit(strip_tags($row->detail_product), 305);

        $komentar = null;

        foreach($reviews as $data) {
            $komentar = $data->content;
        }

        return view('pages.detail', [
            'row' => $row,
            'all_rev' => $all_rev,
            'komentar' => $komentar,
            'reviews' => $reviews,
            'desc_short' => $desc_short
        ]);
    }

    public function reviewsAndComents(Request $request) 
    {
        $dataReviews = Testimonial::where([
                    ['product_id', $request->product_id],
                    ['user_id', $request->user_id],
                ])->first();

        if($dataReviews !== null) {
            $dataReviews->update([
                'rate' => $request->rate,
                'content' => $request->content,
            ]);
            Alert::toast('Your review has been updated!', 'success')->position('top-end');
            return redirect()->back();
        } else {
            $dataReviews = Testimonial::create([
                'product_id' => $request->product_id,
                'user_id' => $request->user_id,
                'rate' => $request->rate,
                'content' => $request->content,
            ]);
            Alert::toast('Your review has been created!', 'info')->position('top-end');
            return redirect()->back();
        }
    }
}
