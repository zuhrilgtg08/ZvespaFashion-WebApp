@extends('layouts.server.main', ['sbActive' => 'dashboard'])

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/flatpickr.min.css') }}" />
@endpush

@section('main-content')
    <h3 class="h3 mb-4 text-gray-800">Setting Account - {{ (auth()->user()->roles_type == 1) ? 'Admin' : 'Karyawan' }}</h3>

    <div class="row justify-content-center">
        <div class="col-xl-7 col-md-7">
            <div class="card border-0 shadow-lg my-5">
                <div class="card-body">
                    <form action="{{ route('admin.setting.update', $row->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name-account" class="form-label">Name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon"><i class="fas fa-user-circle text-primary"></i></span>
                                    </div>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" id="name-account" value="{{ old('name', $row->name) }}" required />
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
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email-address"
                                        value="{{ old('email', $row->email) }}" required />
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
                                    <input type="text" class="form-control @error('job') is-invalid @enderror" name="job" id="job"
                                        value="{{ old('job', $row->job) }}" required />
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
                                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" id="phone_number"
                                        value="{{ old('phone_number', $row->phone_number) }}" required />
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
                                        <span class="input-group-text" id="basic-addon"><i class="fas fa-house-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat"
                                        value="{{ old('alamat', $row->alamat) }}" required />
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
                                    <input type="text" class="form-control @error('birthday') is-invalid @enderror" name="birthday"
                                        id="birthday" value="{{ old('birthday', $row->birthday) }}" required />
                                    @error('birthday')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="foto_profile" class="form-label">Profile Photo</label>
                            <!--hidden OldImage -->
                            <input type="hidden" name="oldImage" value="{{ $row->profile_image }}" />
                            @if ($row->profile_image)
                                <img src="{{ asset('storage/' . $row->profile_image) }}" 
                                    class="img-preview img-fluid mb-3 sm-2 rounded-circle mx-auto d-block" style="width: 200px; height: 200px; object-fit: cover;" />
                            @else
                                <img src="{{ asset('assets/dashboard/img/profile.svg') }}" 
                                    class="img-preview img-fluid mb-3 sm-2 rounded-circle mx-auto d-block" style="width: 200px; height: 200px; object-fit: cover;" />
                            @endif
                            <input type="file" class="form-control-file @error('profile_image') is-invalid @enderror" name="profile_image"
                                id="foto_profile" onchange="previewImg()" />
                            @error('profile_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-3 text-center">
                            <button type="submit" class="btn btn-outline-primary"><i class="fas fa-save"></i> Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-5 col-md-5">
            <div class="card border-0 shadow-lg my-5">
                <div class="card-body">
                    <form action="{{ route('admin.update.password', $row->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon"><i class="fas fa-user-lock"></i></span>
                                </div>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                    name="current_password" id="current_password"
                                        value="{{ old('current_password') }}" required placeholder="Recent your password..."/>
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
                                    name="new_password" id="new_password"
                                        value="{{ old('new_password') }}" required placeholder="New Password..."/>
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
                                    name="confirm_password" id="confirm_password"
                                        value="{{ old('confirm_password') }}" required placeholder="Confirmation..."/>
                                @error('confirm_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-3 text-center">
                            <button type="submit" class="btn btn-outline-primary"><i class="fas fa-save"></i> Save Changes</button>
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
@endpush