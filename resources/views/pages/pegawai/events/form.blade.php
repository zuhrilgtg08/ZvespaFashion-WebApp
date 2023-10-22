@extends('layouts.server.main', ['sbMaster' => true, 'sbActive' => 'data.events'])

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/flatpickr.min.css') }}" />
    <style>
        .image_box {
            width: 45%;
        }
        
        img {
            width: 100%;
        }
        
        .image_name {
            display: block;
            font-size: 14px;
            text-align: center;
        }
    </style>
@endpush

@section('main-content')
    <a class="btn btn-dark" href="{{ route('karyawan.event.index') }}">
        <i class="fas fa-fw fa-arrow-left"></i>
        Back
    </a>
    
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-10">
            <div class="card border-0 shadow-lg my-5">
                <div class="card-header">
                    <h1 class="h2 text-gray-800 text-center">
                        {{ (isset($row->id)) ? 'Edit Pameran - ' . $row->nama_pameran : 'Tambah Pameran Baru' }}
                    </h1>
                </div>
                <div class="card-body">
                    <form action="{{ isset($row->id) ? route('karyawan.event.update', $row->id) : route('karyawan.event.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($row->id)) @method('PUT') @endif
                        <div class="col-xl-12 col-md-12">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="nama_pameran" class="form-label">Tulis Nama Ajang Pameran</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fas fa-calendar-plus"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('nama_pameran') is-invalid @enderror" required
                                            placeholder="Ajang Pameran" name="nama_pameran" id="nama_pameran" value="{{ old('nama_pameran', $row->nama_pameran ?? '') }}" />
                                        @error('nama_pameran')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="place_event" class="form-label">Tulis Tempat Pameran</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fas fa-map-pin"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('place_event') is-invalid @enderror" required
                                            placeholder="Tempat Pameran" name="place_event" id="place_event"
                                            value="{{ old('place_event', $row->place_event ?? '') }}" />
                                        @error('place_event')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                                        value="{{ old('slug', $row->slug ?? '') }}" readonly/>
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="begin_event" class="form-label">Tambah Tgl/Bulan Pameran</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fas fa-bookmark"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('begin_event') is-invalid @enderror" required
                                            placeholder="Tgl/Bulan Mulai Pameran" name="begin_event" id="begin_event"
                                            value="{{ old('begin_event', $row->begin_event ?? '') }}" />
                                        @error('begin_event')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="input-photo-pameran" class="form-label">Upload File Foto Pameran</label>
                                    @if (isset($row->id) && $row->photo_pameran)
                                        @foreach ($row->photo_pameran as $i => $dt)
                                            <input type="hidden" value="{{ $dt }}" name="old_photo_pameran[]" />
                                        @endforeach
                                    @endif
                                    @if (isset($row->id) && $row->photo_pameran)
                                        <div id="image-photo-preview">
                                            @foreach ($row->photo_pameran as $item)
                                                <div class="image_box">
                                                    <img class='img-fluid mb-3 sm-2 d-block' src="{{ asset('storage/' . $item) }}" />
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div id="image-photo-preview"></div>
                                    @endif
                                    <input type="file" class="form-control-file @error('photo_pameran') is-invalid @enderror" 
                                        id="input-photo-pameran" name="photo_pameran[]" multiple/>
                                    <p class="mt-3"><span id="total-img-photo">0</span> File(s) Selected</p>
                                    @error('photo_pameran')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description_event" class="form-label">Tulis Tentang Ajang Pameran</label>
                            <input type="hidden" id="description_event" name="description_event" value="{{ old('description_event', $row->description_event ?? '') }}">
                            <trix-editor input="description_event"></trix-editor>
                            @error('description_event')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-indigo w-25"><i class="fas fa-fw fa-save"></i> Save Event</button>
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
        $("#begin_event").flatpickr({
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
            });
    </script>
    <script>
        const fileInput = document.getElementById('input-photo-pameran');
        const imagePhotoPreview = document.getElementById('image-photo-preview');
        const totalImgPhoto = document.getElementById('total-img-photo');

        // ketika input onChange
        fileInput.addEventListener('change', (event) => {
            const singleImgPhoto = event.target.files;

            // Tampilkan total file img
            totalImgPhoto.innerText = singleImgPhoto.length;

            // set div kosong 
            imagePhotoPreview.innerHTML = '';

            if(singleImgPhoto.length > 0) {
                for(const rowImg of singleImgPhoto) {
                    const reader = new FileReader();

                    // Convert rowImg ke string url
                    reader.readAsDataURL(rowImg);
                    reader.addEventListener('load', () => {
                        // Buat tag img baru tambahkan ke DOM
                        imagePhotoPreview.innerHTML += 
                        `<div class="image_box">
                            <img class='img-fluid mb-3 sm-2' src='${reader.result}'>
                            <span class='image_name'>${rowImg.name}</span>
                        </div>
                        `;
                    });
                }
            } else {
                // Div image kosong
                imagePhotoPreview.innerHTML = '';
            }
        });

        const title = document.querySelector('#nama_pameran');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function(){
            fetch('/karyawan/manage_data/event/checkSlug?title=' + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
        });

        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        });
    </script>
@endpush