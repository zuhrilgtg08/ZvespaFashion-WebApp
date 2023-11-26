<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Models\Vespa;
use Illuminate\Http\Request;

class FrontPopularController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_data = Vespa::with('testimoni')->latest()->get();

        $rating = $all_data->map(function ($query) {
            $rate = Testimonial::where('product_id', '=', $query->id)->get();
            if ($rate->count() == 0) {
                $query->rate = 0;
            } else {
                $dataRating = $rate->sum('rate') / $rate->count();
                $query->rate = $dataRating;
            }

            return $query;
        });

        $datas = $rating->filter(function ($row) {
            return $row->rate >= 3;
        });

        return view('pages.users.popular', [
            'datas' => $datas
        ]);
    }
}
