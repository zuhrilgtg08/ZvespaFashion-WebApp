@extends('layouts.server.main', ['sbMaster' => true, 'sbActive' => 'data.porto'])

@section('main-content')
    <a class="btn btn-dark" href="{{ route('karyawan.portofolio.index') }}">
        <i class="fas fa-fw fa-arrow-left"></i>
        Back
    </a>

    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-10">
            <div class="card border-0 shadow-lg my-5">
                <div class="card-header">
                    <h1 class="h2 text-gray-800 text-center">
                        {{ (isset($row->id)) ? 'Edit Projek Portofolio - ' . $row->title_porto : 'Tambah Projek Portofolio' }}
                    </h1>
                </div>
                <div class="card-body">
                    <form action="{{ isset($row->id) ? route('karyawan.portofolio.update', $row->id) : route('karyawan.portofolio.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($row->id)) @method('PUT') @endif

                        <div class="col-xl-12 col-md-12">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="title_porto" class="form-label">Tulis Nama Projek Yang dibuat</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fas fa-project-diagram"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('title_porto') is-invalid @enderror" required
                                            placeholder="Nama Projek" name="title_porto" id="title_porto" 
                                                value="{{ old('title_porto', $row->title_porto ?? '') }}" />
                                        @error('title_porto')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                                        value="{{ old('slug', $row->slug ?? '') }}" readonly/>
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="link_porto" class="form-label">Tambahkan Link Projek</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fas fa-link"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('link_porto') is-invalid @enderror" required
                                            placeholder="Tulis Link Projek" name="link_porto" id="link_porto"
                                                value="{{ old('link_porto', $row->link_porto ?? '') }}" />
                                        @error('link_porto')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="year" class="form-label">Tahun Pembuatan Projek</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fab fa-earlybirds"></i></span>
                                        </div>
                                        <input type="number" min="1" class="form-control @error('year') is-invalid @enderror" required
                                            placeholder="Tahun Dibuat" name="year" id="year"
                                                value="{{ old('year', $row->year ?? '') }}" />
                                        @error('year')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="image_porto" class="form-label">Upload Gambar Projek</label>
                            @if(isset($row->id) && $row->image_porto)
                                <!--hidden OldImage -->
                                <input type="hidden" name="oldImage_porto" value="{{ $row->image_porto ?? '' }}" />
                            @endif
                            @if (isset($row->id) && $row->image_porto)
                                <img src="{{ asset('storage/' . $row->image_porto) }}" class="img-preview img-fluid mb-3 sm-2 d-block"/>
                            @else 
                                <img class="img-preview img-fluid mb-3 sm-2"/>
                            @endif
                            <input type="file" class="form-control-file @error('image_porto') is-invalid @enderror" 
                                name="image_porto" id="image_porto" onchange="previewImage()"/>
                            @error('image_porto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Tulis Tentang Detail Projek</label>
                            <input type="hidden" id="description" name="description" value="{{ old('description', $row->description ?? '') }}">
                            <trix-editor input="description"></trix-editor>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-indigo w-25"><i class="fas fa-fw fa-save"></i> Save Portofolio</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function previewImage() {
            const imageInput = document.querySelector('#image_porto');
            const imagePreview = document.querySelector('.img-preview');
            imagePreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(imageInput.files[0]);

            oFReader.onload = function(oFREvent) {
                imagePreview.src = oFREvent.target.result;
            }
        }

        const title = document.querySelector('#title_porto');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function(){
            fetch('/karyawan/manage_data/portofolio/checkSlug?title=' + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
        });

        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        });
    </script>
@endpush