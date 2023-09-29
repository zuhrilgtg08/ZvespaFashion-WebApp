<?php

namespace App\Http\Controllers\Data;
use App\Models\User;
use App\Models\Provinces;
use App\Models\Cities;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class ManageKaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = User::where('roles_type', '=', 2)->get([
                'id',
                'name',
                'profile_image',
                'email',
                'job',
            ]);

            return DataTables::of($query)
                ->addColumn('action', function ($row) {
                    return '
                            <a href="/manage_dashboard/manage_karyawan/' . $row->id . '/edit" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                            <form action="http://localhost:3000/manage_dashboard/manage_karyawan/' . $row->id . '" method="POST" class="d-inline">
                                ' . method_field('delete') . csrf_field() . '
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus</button>
                            </form>
                        ';
                })
                ->editColumn('profile_image', function($row) {
                    return asset('storage/' . $row->profile_image);
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('pages.admin.dataKaryawan.view');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinsi = Provinces::get(['id', 'name_province']);
        return view('pages.admin.dataKaryawan.form', ['provinsi' => $provinsi]);
    }

    public function chooseCity(string $id)
    {
        $kota = Cities::where('province_id', '=', $id)->select(['id', 'nama_kab_kota'])->get();
        return response()->json($kota);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users|string|max:255',
            'new_password' => 'min:8|required',
            'password' => 'required|same:new_password|min:8',
            'u_prov_id' => 'required|max:255',
            'u_kota_id' => 'required|max:155',
            'alamat' => 'string|max:100',
            'job' => 'string|max:150',
            'phone_number' => 'required|numeric|min:12',
            'religion' => 'required|string|max:155',
            'birthday' => 'date|required|string',
            'bio_user' => 'required|string',
            'profile_image' => 'image|max:2048|mimes:jpeg,jpg,svg,png|nullable',
            'roles_type' => 'integer|numeric'
        ]);

        $phone = $request->phone_number;

        if ($phone) {
            $result = sprintf("%s-%s-%s", substr($phone, 0, 4), substr($phone, 4, 4), substr($phone, 8));
            $validateData['phone_number'] = $result;
        }

        if ($request->file('profile_image')) {
            $validateData['profile_image'] = $request->file('profile_image')->store('foto_karyawan');
        }

        $validateData['roles_type'] = 2;

        $validateData['excerpt'] = Str::limit(strip_tags($request->bio_user), 50);

        $karyawan = User::where('roles_type', 2)->create($validateData);

        if($karyawan) {
            Alert::toast('New Employee has been created!', 'success')->position('top-end');
            return redirect()->route('admin.manage_karyawan.index');
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
        $provinsi = Provinces::get(['id', 'name_province']);
        $row = User::where([['roles_type', '=', 2], ['id', '=', $id]])->first();
        $kota = Cities::where('province_id', '=', $row->u_prov_id)->get();

        return view('pages.admin.dataKaryawan.form',[
            'row' => $row,
            'provinsi' => $provinsi,
            'kota' => $kota,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'u_prov_id' => 'required|max:255',
            'u_kota_id' => 'required|max:155',
            'alamat' => 'string|max:100',
            'job' => 'string|max:150',
            'phone_number' => 'required|numeric|min:12',
            'religion' => 'required|string|max:155',
            'birthday' => 'date|required|string',
            'bio_user' => 'required|string',
            'profile_image' => 'image|max:2048|mimes:jpeg,jpg,svg,png|nullable',
            'roles_type' => 'integer|numeric'
        ]);

        if($request->file('profile_image')) {
            if($request->oldImage_karyawan) {
                Storage::delete($request->oldImage_karyawan);
            }
            $validateData['profile_image'] = $request->file('profile_image')->store('foto_karyawan');
        }

        $phone = $request->phone_number;

        if ($phone) {
            $result = sprintf("%s-%s-%s", substr($phone, 0, 4), substr($phone, 4, 4), substr($phone, 8));
            $validateData['phone_number'] = $result;
        }

        $validateData['roles_type'] = 2;

        $validateData['excerpt'] = Str::limit(strip_tags($request->bio_user), 50);

        $karyawan = User::where([['roles_type', '=', 2], ['id', $id]])->first();
        $karyawan->update($validateData);

        if($karyawan) {
            Alert::toast('This employee has been updated!', 'success')->position('top-end');
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
        $data = User::where([['roles_type', 2], ['id', $id]])->first();

        if($data->profile_image) {
            Storage::delete($data->profile_image);
        }

        $data->destroy($id);
        Alert::toast('This karyawan data has been deleted!', 'success')->position('top-end');
        return redirect()->route('admin.manage_karyawan.index');
    }
}
