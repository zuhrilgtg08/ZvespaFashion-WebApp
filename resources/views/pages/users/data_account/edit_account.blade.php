@extends('layouts.client.master')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/flatpickr.min.css') }}" />
@endpush

@section('master-content')
    <div class="container-fluid">
        <a href="/home" class="btn btn-dark rounded-pill ml-5"><i class="fas fa-arrow-alt-circle-left"></i> Kembali </a>
        <div class="row justify-content-center">
            <h1 class="section-title px-5 text-center mb-3"><span class="px-2">Edit Profile Account</span></h1>
            <div class="col-lg-10 col-md-10">
                <div class="row justify-content-center">
                    <div class="col-xl-12 col-md-12">
                        <div class="card border-0 shadow-lg my-3 rounded-lg">
                            <div class="card-body">
                                <form action="{{ route('update.data', $akun->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="name-account" class="form-label">Name</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon"><i class="fas fa-user-circle text-primary"></i></span>
                                                </div>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                                    id="name-account" value="{{ old('name', $akun->name) }}" required />
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="email-address" class="form-label">Email Address</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon"><i class="fas fa-envelope text-warning"></i></span>
                                                </div>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                                    id="email-address" value="{{ old('email', $akun->email) }}" required />
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="job" class="form-label">Job Position</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon"><i class="fas fa-sticky-note"></i></span>
                                                </div>
                                                <input type="text" class="form-control @error('job') is-invalid @enderror" name="job"
                                                    id="job" value="{{ old('job', $akun->job) }}" required />
                                                @error('job')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="phone_number" class="form-label">Phone Number</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon"><i class="fas fa-phone-alt text-success"></i></span>
                                                </div>
                                                <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                                    name="phone_number" id="phone_number" value="{{ old('phone_number', $akun->phone_number) }}" required />
                                                @error('phone_number')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="alamat" class="form-label">Address Info</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon"><i class="fas fa-house-damage"></i></span>
                                                </div>
                                                <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                                                    id="alamat" value="{{ old('alamat', $akun->alamat) }}" required />
                                                @error('alamat')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="birthday" class="form-label">Birthday Info</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon"><i class="fas fa-calendar"></i></span>
                                                </div>
                                                <input type="text" class="form-control @error('birthday') is-invalid @enderror"
                                                    name="birthday" id="birthday" value="{{ old('birthday', $akun->birthday) }}" required />
                                                @error('birthday')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="provinsi" class="form-label">Data Provinsi*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon"><i class="fab fa-skyatlas"></i></span>
                                                </div>
                                                <select class="form-control" name="u_prov_id" id="provinsi">
                                                    <option selected disabled>Pilih Provinsi</option>
                                                    @foreach ($provinsi as $item)
                                                        <option value="{{ $item->id }}" {{ isset($akun->id) && $akun->u_prov_id == $item->id ? 'selected' : ''}}>
                                                            {{ $item->name_province }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="kota" class="form-label">Data Kota/Kabupaten*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon"><i class="fas fa-city"></i></span>
                                                </div>
                                                <select class="form-control" name="u_kota_id" id="kota">
                                                    @if (isset($akun->id) || isset($akun->kota->id))
                                                        @foreach ($kota as $item)
                                                            <option value="{{ isset($akun->id) ? $item->id : $akun->u_kota_id }}"
                                                                {{ isset($akun->id) && $akun->u_kota_id == $item->id ? 'selected' : ''}}>
                                                                {{ isset($akun->id) ? $item->nama_kab_kota : $akun->kota->nama_kab_kota}}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        <option selected disabled>Pilih Kota/Kabupaten</option>
                                                    @endif
                                                </select>
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
                                                    <option value="islam" {{ ($akun->religion == 'islam') ? 'selected' : ''}}>Islam</option>
                                                    <option value="kristen" {{ ($akun->religion == 'kristen') ? 'selected' : ''}}>Kristen</option>
                                                    <option value="katolik" {{ ($akun->religion == 'katollik') ? 'selected' : ''}}>Katolik</option>
                                                    <option value="hindu" {{ ($akun->religion == 'hindu') ? 'selected' : ''}}>Hindu</option>
                                                    <option value="budha" {{ ($akun->religion == 'budha') ? 'selected' : ''}}>Budha</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="foto_profile" class="form-label">Profile Photo</label>
                                        <!--hidden OldImage -->
                                        <input type="hidden" name="oldImage" value="{{ $akun->profile_image }}" />
                                        @if ($akun->profile_image)
                                            <img src="{{ asset('storage/' . $akun->profile_image) }}"
                                                class="img-preview img-fluid mb-3 sm-2 rounded-circle mx-auto d-block"
                                                style="width: 200px; height: 200px; object-fit: cover;" />
                                        @else
                                            <img src="{{ asset('assets/dashboard/img/profile.svg') }}"
                                                class="img-preview img-fluid mb-3 sm-2 rounded-circle mx-auto d-block"
                                                style="width: 200px; height: 200px; object-fit: cover;" />
                                        @endif
                                            <input type="file" class="form-control-file @error('profile_image') is-invalid @enderror"
                                                name="profile_image" id="foto_profile" onchange="previewImg()" />
                                        @error('profile_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="bio_user" class="form-label">Tulis Tentang Data Kamu</label>
                                        <input type="hidden" id="bio_user" name="bio_user" value="{{ old('bio_user', $akun->bio_user ?? '') }}">
                                        <trix-editor input="bio_user"></trix-editor>
                                        @error('bio_user')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mt-3 text-center">
                                        <button type="submit" class="btn btn-success rounded-pill"><i class="fas fa-save"></i> 
                                            Save Changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-md-8">
                        <div class="card border-0 shadow-lg rounded-lg my-3">
                            <div class="card-body">
                                <form action="{{ route('update.password.account', $akun->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="current_password" class="form-label">Current Password</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon"><i class="fas fa-user-lock"></i></span>
                                            </div>
                                            <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                                name="current_password" id="current_password" value="{{ old('current_password') }}" required
                                                placeholder="Recent your password..." />
                                            @error('current_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_password" class="form-label">Create New Password</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon"><i class="fas fa-key"></i></span>
                                            </div>
                                            <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                                name="new_password" id="new_password" value="{{ old('new_password') }}" required
                                                placeholder="New Password..." />
                                            @error('new_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirm_password" class="form-label">Confirm Password</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon"><i class="fas fa-user-check"></i></span>
                                            </div>
                                            <input type="password" class="form-control @error('confirm_password') is-invalid @enderror"
                                                name="confirm_password" id="confirm_password" value="{{ old('confirm_password') }}" required
                                                placeholder="Confirmation..." />
                                            @error('confirm_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mt-3 text-center">
                                        <button type="submit" class="btn btn-success rounded-pill"><i class="fas fa-save"></i> 
                                            Save Changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
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
                const imageInput = document.querySelector('#foto_profile');
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
                            url: "/data/kota/" + provinces,
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