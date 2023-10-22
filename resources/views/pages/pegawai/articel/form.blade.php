@extends('layouts.server.main', ['sbMaster' => true, 'sbActive' => 'data.artikel'])

@push('style')
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
    <a class="btn btn-dark" href="{{ route('karyawan.articel.index') }}">
        <i class="fas fa-fw fa-arrow-left"></i>
        Back
    </a>

    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-10">
            <div class="card border-0 shadow-lg my-5">
                <div class="card-header">
                    <h1 class="h2 text-gray-800 text-center">{{ (isset($row->id)) ? 'Edit Artikel Saya' : 'Buat Artikel Baru' }}</h1>
                </div>
                <div class="card-body">
                    <form action="{{ isset($row->id) ? route('karyawan.articel.update', $row->id) : route('karyawan.articel.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($row->id)) @method('PUT') @endif
                        <div class="col-xl-12 col-md-12">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="title" class="form-label">Tulis Judul Artikel</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon">@</span>
                                        </div>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" required
                                            placeholder="Judul Artikel" name="title" id="title" 
                                            value="{{ old('title', $row->title ?? '') }}"/>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="kategori" class="form-label">List Kategori</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fas fa-th-list"></i></span>
                                        </div>
                                        <select class="custom-select" name="category_id" id="kategori">
                                            <option selected disabled>Pilih Kategori</option>
                                            @foreach ($kategori as $item)
                                                <option value="{{ $item->id }}" {{ isset($row->id) && $row->category_id == $item->id ? 'selected' : ''}}>
                                                    {{ $item->name_category }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                                        value="{{ old('slug', $row->slug ?? '') }}">
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="label_name" class="form-label">Creator</label>
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}"/>
                                    <input type="text" class="form-control" disabled id="input_name" value="{{ auth()->user()->name }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="input-photo-articel" class="form-label">Upload File Foto Artikel</label>
                                    @if (isset($row->id) && $row->photo_articel)
                                        @foreach ($row->photo_articel as $i => $dt)
                                            <input type="hidden" value="{{ $dt }}" name="old_photo_articel[]" />
                                        @endforeach
                                    @endif
                                    @if (isset($row->id) && $row->photo_articel)
                                        <div id="image-photo-preview">
                                            @foreach ($row->photo_articel as $item)
                                                <div class="image_box">
                                                    <img class='img-fluid mb-3 sm-2 d-block' src="{{ asset('storage/' . $item) }}" />
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div id="image-photo-preview"></div>
                                    @endif
                                    <input type="file" class="form-control-file @error('photo_articel') is-invalid @enderror" 
                                        id="input-photo-articel" name="photo_articel[]" multiple/>
                                    <p class="mt-3"><span id="total-img-photo">0</span> File(s) Selected</p>
                                    @error('photo_articel')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="thumbnail-articel" class="form-label">Upload Thumbnail Artikel</label>
                                    @if(isset($row->id) && $row->thumbnail)
                                        <!--hidden OldImage -->
                                        <input type="hidden" name="oldImage_thumbnail" value="{{ $row->thumbnail ?? '' }}" />
                                    @endif
                                    @if (isset($row->id) && $row->thumbnail)
                                        <img src="{{ asset('storage/' . $row->thumbnail) }}" class="img-preview img-fluid mb-3 sm-2 d-block"/>
                                    @else 
                                        <img class="img-preview img-fluid mb-3 sm-2"/>
                                    @endif
                                    <input type="file" class="form-control-file @error('thumbnail') is-invalid @enderror" 
                                        name="thumbnail" id="thumbnail-articel" onchange="previewThumbnail()"/>
                                    @error('thumbnail')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Isi Konten Blog</label>
                            <input type="hidden" id="content_blog" name="content" value="{{ old('content', $row->content ?? '') }}">
                            <trix-editor input="content_blog"></trix-editor>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-indigo w-25"><i class="fas fa-fw fa-save"></i> Save Artikel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        const fileInput = document.getElementById('input-photo-articel');
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
        })

        function previewThumbnail() {
            const imageInput = document.querySelector('#thumbnail-articel');
            const imagePreview = document.querySelector('.img-preview');
            imagePreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(imageInput.files[0]);

            oFReader.onload = function(oFREvent) {
                imagePreview.src = oFREvent.target.result;
            }
        }

        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function(){
            fetch('/karyawan/manage_data/articel/checkSlug?title=' + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
        });

        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        });
    </script>
@endpush