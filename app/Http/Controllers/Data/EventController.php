<?php

namespace App\Http\Controllers\Data;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Web_Builder\Events;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $query = Events::select(
                'id', 'nama_pameran', 'begin_event', 'place_event'
            )->get();

            return DataTables::of($query)
                ->addColumn('action', function ($row) {
                    return '
                            <a href="/manage_data/event/' . $row->id . '/edit" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                            <form action="http://localhost:3000/manage_data/event/' . $row->id . '" method="POST" class="d-inline">
                                ' . method_field('delete') . csrf_field() . '
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus</button>
                            </form>
                        ';
                })
                ->editColumn('begin_event', function($row){
                    $formatedDate = Carbon::createFromFormat('Y-m-d', $row->begin_event)->format('j F, Y');
                    return $formatedDate;
                })
                ->rawColumns(['action', 'begin_event'])
                ->addIndexColumn() 
                ->make(true);
        }

        return view('pages.pegawai.events.view');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.pegawai.events.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_pameran' => 'required|string',
            'slug' => 'required|string',
            'photo_pameran' => 'nullable|array',
            'place_event' => 'required|string|max:255',
            'begin_event' => 'nullable|date|string',
            'description_event' => 'required|string',
        ]);

        $foto_event = $request->file('photo_pameran');
        $img_event = [];

        foreach ($foto_event as $dtImg) {
            $path = $dtImg->store('gambar_pameran', 'public');
            array_push($img_event, $path);
        }

        $validateData['photo_pameran'] = $img_event;

        $data = Events::create($validateData);

        if ($data) {
            Alert::toast('New event has been created!', 'success')->position('top-end');
            return redirect()->route('karyawan.event.index');
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
        $row = Events::findOrFail($id);
        return view('pages.pegawai.events.form', ['row' => $row]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'nama_pameran' => 'required|string',
            'slug' => 'required|string',
            'photo_pameran' => 'nullable|array',
            'place_event' => 'required|string|max:255',
            'begin_event' => 'nullable|date|string',
            'description_event' => 'required|string',
        ]);

        if ($request->file('photo_pameran')) {
            $newImg = [];
            if ($request->old_photo_pameran) {
                Storage::delete($request->old_photo_pameran);
            }
            foreach ($request->file('photo_pameran') as $data) {
                $path = $data->store('photo_pameran', 'public');
                $newImg[] = $path;
            }
            $validateData['photo_pameran'] = $newImg;
        }

        $row = Events::findOrFail($id)->update($validateData);

        if ($row) {
            Alert::toast('This event has been updated!', 'success')->position('top-end');
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
        $data = Events::findOrFail($id);

        if ($data->photo_pameran) {
            Storage::delete($data->photo_pameran);
        }

        $data->destroy($id);
        Alert::toast('This Event has been deleted!', 'success')->position('top-end');
        return redirect()->route('karyawan.event.index');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Events::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
