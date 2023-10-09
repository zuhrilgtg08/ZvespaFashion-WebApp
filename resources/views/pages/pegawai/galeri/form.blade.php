@extends('layouts.server.main', ['sbMaster' => true, 'sbActive' => 'data.galeri'])

@section('main-content')
    <a class="btn btn-dark" href="{{ route('karyawan.galeri.index') }}">
        <i class="fas fa-fw fa-arrow-left"></i>
        Back
    </a>
    
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-10">
            <div class="card border-0 shadow-lg my-5">
                <div class="card-header">
                    <h1 class="h2 text-gray-800 text-center">{{ (isset($row->id)) ? 'Edit Gambar Produk' : 'Input Gambar Baru' }}</h1>
                </div>
                <div class="card-body">
                    <form action="{{ isset($row->id) ? route('karyawan.galeri.update', $row->id) : route('karyawan.galeri.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        @if (isset($row->id)) @method('PUT') @endif
                        <div class="row justify-content-between">
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label for="data_vespa" class="form-label">List Vespa</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon"><i class="fas fa-cubes text-success"></i></span>
                                    </div>
                                    <select class="custom-select" name="product_id" id="data_vespa">
                                        <option selected disabled>Pilih Motor</option>
                                        @foreach ($vespa as $item)
                                            <option value="{{ $item->id }}" {{ isset($row->id) && $row->product_id == $item->id ? 'selected' : ''}}>
                                                {{ $item->name_product }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="photos-product" class="form-label">Upload Foto Content</label>
                                @if(isset($row->id) && $row->photos)
                                    <!--hidden OldImage -->
                                    <input type="hidden" name="oldPhotos" value="{{ $row->photos ?? '' }}" />
                                @endif
                                <input type="file" class="form-control-file mb-3 @error('photos') is-invalid @enderror" name="photos" id="photos-product"
                                    onchange="preview()" />
                                @error('photos')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if (isset($row->id) && $row->photos)
                                    <img src="{{ asset('storage/' . $row->photos) }}" class="img-preview img-fluid mb-3 sm-2 d-block"/>
                                @else 
                                    <img class="img-preview img-fluid mb-3 sm-2"/>
                                @endif
                            </div>
                        </div>
                        <div class="my-3 mx-auto text-center">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-fw fa-check-circle"></i> Simpan Gambar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function preview() {
            const imageInput = document.querySelector('#photos-product');
            const imagePreview = document.querySelector('.img-preview');
            imagePreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(imageInput.files[0]);

            oFReader.onload = function(oFREvent) {
                imagePreview.src = oFREvent.target.result;
            }
        }
    </script>
@endpush