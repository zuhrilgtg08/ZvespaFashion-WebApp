@extends('layouts.server.main', ['sbMaster' => true, 'sbActive' => 'data.vespa'])

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
    <a class="btn btn-dark" href="{{ route('admin.vespa.index') }}">
        <i class="fas fa-fw fa-arrow-left"></i>
        Back
    </a>

    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-10">
            <div class="card border-0 shadow-lg my-5">
                <div class="card-header">
                    <h1 class="h2 text-gray-800 text-center">{{ (isset($row->id)) ? 'Edit Produk' : 'Produk Baru' }}</h1>
                </div>
                <div class="card-body">
                    <form action="{{ isset($row->id) ? route('admin.vespa.update', $row->id) : route('admin.vespa.store') }}" 
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($row->id)) @method('PUT') @endif
                        <div class="col-xl-12 col-md-12">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="name-product" class="form-label">Nama Produk</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fas fa-sign"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('name_product') is-invalid @enderror" 
                                            placeholder="Nama Produk" name="name_product" id="name-product" 
                                            value="{{ old('name_product', $row->name_product ?? '') }}" required />
                                        @error('name_product')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="nomor-seri" class="form-label">Nomor Seri</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fas fa-location-arrow"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('nomor_seri') is-invalid @enderror" required 
                                            placeholder="Nomor Seri" name="nomor_seri" id="nomor-seri" 
                                            value="{{ old('nomor_seri', $row->nomor_seri ?? '') }}"/>
                                        @error('nomor_seri')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="launch-year" class="form-label">Tahun Produk</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fas fa-calendar-plus"></i></span>
                                        </div>
                                        <input type="number" class="form-control @error('launch_year') is-invalid @enderror" required
                                            placeholder="Tahun Produk" name="launch_year" id="launch-year" 
                                            value="{{ old('launch_year', $row->launch_year ?? '') }}"/>
                                        @error('launch_year')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="stock-product" class="form-label">Stok Produk</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fas fa-cubes"></i></span>
                                        </div>
                                        <input type="number" class="form-control @error('stock_product') is-invalid @enderror" required
                                            placeholder="Stok Produk" name="stock_product" id="stock-product" 
                                            value="{{ old('stock_product', $row->stock_product ?? '') }}"/>
                                        @error('stock_product')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="harga-product" class="form-label">Harga Produk</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon">Rp.</span>
                                        </div>
                                        <input type="number" class="form-control @error('harga_product') is-invalid @enderror" required
                                            placeholder="Harga Produk" name="harga_product" id="harga-product" 
                                            value="{{ old('harga_product', $row->harga_product ?? '') }}"/>
                                        @error('harga_product')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="kategori" class="form-label">Kategori Produk</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fas fa-th-list"></i></span>
                                        </div>
                                       <select class="custom-select" name="category_id" id="kategori">
                                        <option selected disabled>Pilih Kategori</option>
                                        @foreach ($kategori as $item)
                                            <option value="{{ isset($row->id) ? $row->category_id : $item->id }}"
                                                {{ isset($row->id) && $row->category_id == $item->id ? 'selected' : ''}}>
                                                    {{ isset($row->id) ? $row->category->name_category : $item->name_category }}
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

@push('script')
    <script>
        const fileInput = document.getElementById('input-photo-product');
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
            const imageInput = document.querySelector('#thumbnail-product');
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