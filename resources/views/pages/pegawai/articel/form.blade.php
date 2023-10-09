@extends('layouts.server.main', ['sbMaster' => true, 'sbActive' => 'data.artikel'])

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
                                <div class="col-md-6 mb-3">
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
                                <div class="col-md-4 mb-3">
                                    <label for="kategori" class="form-label">List Kategori</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fas fa-th-list"></i></span>
                                        </div>
                                       <select class="custom-select" name="category_id" id="kategori">
                                        <option selected disabled>Pilih Kategori</option>
                                        @foreach ($kategori as $item)
                                            <option value="{{ $item->id }}"
                                                {{ isset($row->id) && $row->category_id == $item->id ? 'selected' : ''}}>
                                                {{ $item->name_category }}
                                            </option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="input-photo-product" class="form-label">Upload File Photo</label>
                                    @if (isset($row->id) && $row->photo_product)
                                        @foreach ($row->photo_product as $i => $dt)
                                            <input type="hidden" value="{{ $dt }}" name="old_photo_product[]" />
                                        @endforeach
                                    @endif
                                    @if (isset($row->id) && $row->photo_product)
                                        <div id="image-photo-preview">
                                            @foreach ($row->photo_product as $item)
                                                <div class="image_box">
                                                    <img class='img-fluid mb-3 sm-2 d-block' src="{{ asset('storage/' . $item) }}" />
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div id="image-photo-preview"></div>
                                    @endif
                                    <input type="file" class="form-control-file @error('photo_product') is-invalid @enderror" 
                                        id="input-photo-product" name="photo_product[]" multiple/>
                                    <p class="mt-3"><span id="total-img-photo">0</span> File(s) Selected</p>
                                    @error('photo_product')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="thumbnail-product" class="form-label">Upload Single Thumbnail</label>
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
                                        name="thumbnail" id="thumbnail-product" onchange="previewThumbnail()"/>
                                    @error('thumbnail')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="detail_product" class="form-label">Detail Produk</label>
                            <input type="hidden" id="detail_product" name="detail_product" value="{{ old('detail_product', $row->detail_product ?? '') }}">
                            <trix-editor input="detail_product"></trix-editor>
                            @error('detail_product')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary w-25">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection