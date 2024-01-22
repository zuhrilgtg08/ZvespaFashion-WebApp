@extends('layouts.server.main', ['sbMaster' => true, 'sbActive' => 'data.karyawan'])

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/flatpickr.min.css') }}"/>
@endpush

@section('main-content')
    <a class="btn btn-dark" href="{{ route('admin.manage_karyawan.index') }}">
        <i class="fas fa-fw fa-arrow-left"></i>
        Back
    </a>

    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-10">
            <div class="card border-0 shadow-lg my-5">
                <div class="card-header">
                    <h1 class="h2 text-gray-800 text-center">{{ (isset($row->id)) ? 'Edit Data Karyawan' : 'Tambah Karyawan Baru' }}</h1>
                </div>
                <div class="card-body">
                    <form action="{{ isset($row->id) ? route('admin.manage_karyawan.update', $row->id) : route('admin.manage_karyawan.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($row->id)) @method('PUT') @endif
                        <div class="col-xl-12 col-md-12">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fas fa-file-signature"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Tulis Nama Lengkap" name="name" id="name"
                                            value="{{ old('name', $row->name ?? '') }}" required />
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email Karyawan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            required placeholder="Akun Email" name="email" id="email"
                                            value="{{ old('email', $row->email ?? '') }}" />
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12 {{ (isset($row->id) ? 'd-none' : '') }}">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="new_password" class="form-label">Buat Password</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fas fa-user-lock"></i></span>
                                        </div>
                                        <input type="password" class="form-control @error('new_password') is-invalid @enderror" {{ (isset($row->id) ? 'disabled' : 'required') }}
                                            placeholder="Buat Password" name="new_password" id="new_password"
                                            value="{{ old('new_password') }}" />
                                        @error('new_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Konfirmasi Password</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fas fa-key"></i></span>
                                        </div>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" {{ (isset($row->id) ? 'disabled' : 'required') }}
                                            placeholder="Konfirmasi Password" name="password" id="password"
                                            value="{{ old('password') }}" />
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="provinsi" class="form-label">Data Provinsi</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fab fa-skyatlas"></i></span>
                                        </div>
                                        <select class="form-control" name="u_prov_id" id="provinsi">
                                            <option selected disabled>Pilih Provinsi</option>
                                            @foreach ($provinsi as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ isset($row->id) && $row->u_prov_id == $item->id ? 'selected' : ''}}>
                                                    {{ $item->name_province }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="kota" class="form-label">Data Kota/Kabupaten</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fas fa-city"></i></span>
                                        </div>
                                        <select class="form-control" name="u_kota_id" id="kota">
                                            @if (isset($row->id) || isset($row->kota->id))
                                                @foreach ($kota as $item)
                                                    <option value="{{ isset($row->id) ? $item->id : $row->u_kota_id }}"
                                                        {{ isset($row->id) && $row->u_kota_id == $item->id ? 'selected' : ''}}>
                                                        {{ isset($row->id) ? $item->nama_kab_kota : $row->kota->nama_kab_kota}}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option selected disabled>Pilih Kota/Kabupaten</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fas fa-home"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" required
                                            placeholder="Tulis Alamat" name="alamat" id="alamat"
                                            value="{{ old('alamat', $row->alamat ?? '') }}" />
                                        @error('alamat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="job" class="form-label">Job Karyawan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fas fa-briefcase"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('job') is-invalid @enderror" required
                                            placeholder="Tulis Job" name="job" id="job" value="{{ old('job', $row->job ?? '') }}" />
                                        @error('job')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="phone_number" class="form-label">No/Telp Karyawan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fas fa-phone-square-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('phone_number') is-invalid @enderror" required 
                                            placeholder="Tulis No/Telp Karyawan" name="phone_number" id="phone_number" 
                                                value="{{ old('phone_number', $row->phone_number ?? '') }}" />
                                        @error('phone_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="agama" class="form-label">Agama</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fas fa-praying-hands"></i></span>
                                        </div>
                                        <select class="custom-select" name="religion" id="agama">
                                            <option selected disabled>Pilih Agama</option>
                                            <option value="{{ isset($row->id) ? $row->religion : 'islam' }}" {{ isset($row->id) && $row->religion == 'islam' ? 'selected' : ''}}>Islam</option>
                                            <option value="{{ isset($row->id) ? $row->religion : 'kristen' }}" {{ isset($row->id) && $row->religion == 'kristen' ? 'selected' : ''}}>Kristen</option>
                                            <option value="{{ isset($row->id) ? $row->religion : 'katolik' }}" {{ isset($row->id) && $row->religion == 'katollik' ? 'selected' : ''}}>Katolik</option>
                                            <option value="{{ isset($row->id) ? $row->religion : 'hindu' }}" {{ isset($row->id) && $row->religion == 'hindu' ? 'selected' : ''}}>Hindu</option>
                                            <option value="{{ isset($row->id) ? $row->religion : 'budha' }}" {{ isset($row->id) && $row->religion == 'budha' ? 'selected' : ''}}>Budha</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="foto-karyawan" class="form-label">Upload Foto Karyawan</label>
                                    @if(isset($row->id) && $row->profile_image)
                                        <!--hidden OldImage -->
                                        <input type="hidden" name="oldImage_karyawan" value="{{ $row->profile_image ?? '' }}" />
                                    @endif
                                    @if (isset($row->id) && $row->profile_image)
                                        <img src="{{ asset('storage/' . $row->profile_image) }}" class="img-preview img-fluid mb-3 sm-2 d-block" />
                                    @else
                                        <img class="img-preview img-fluid mb-3 sm-2" />
                                    @endif
                                    <input type="file" class="form-control-file @error('profile_image') is-invalid @enderror" name="profile_image"
                                        id="foto-karyawan" onchange="previewImg()" />
                                    @error('profile_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="birthday" class="form-label">Tambah Tgl/Bulan Lahir</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('birthday') is-invalid @enderror" required
                                            placeholder="Tgl/Bulan Lahir" name="birthday" id="birthday"
                                            value="{{ old('birthday', $row->birthday ?? '') }}" />
                                        @error('birthday')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="bio_user" class="form-label">Tulis Tentang Data Karyawan</label>
                            <input type="hidden" id="bio_user" name="bio_user"
                                value="{{ old('bio_user', $row->bio_user ?? '') }}">
                            <trix-editor input="bio_user"></trix-editor>
                            @error('bio_user')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary w-25"><i class="fas fa-fw fa-save"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/dashboard/js/flatpickr.min.js') }}"></script>
    <script>
        $("#birthday").flatpickr({
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        });
    </script>
    <script>
        function previewImg() {
            const imageInput = document.querySelector('#foto-karyawan');
            const imagePreview = document.querySelector('.img-preview');
            imagePreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(imageInput.files[0]);

            oFReader.onload = function(oFREvent) {
                imagePreview.src = oFREvent.target.result;
            }
        }

        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('select[name="u_prov_id"]').on('change', function() {
                let provinces = $(this).val();
                if(provinces) {
                    $.ajax({
                        type: "GET",
                        url: "/admin/manage_dashboard/city/" + provinces,
                        dataType: "json",
                        success: function (response) {
                            $('select[name="u_kota_id"]').empty();
                            $.each(response, function(key, value) {
                                $('select[name="u_kota_id"]').append(
                                    '<option value="'+ value.id +'">' + value.nama_kab_kota + '</option>'
                                );
                            });
                        }
                    });
                } else {
                    $('select[name="u_kota_id"]').empty();
                }
            });
        });
    </script>
@endpush