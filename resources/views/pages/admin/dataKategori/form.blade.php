@extends('layouts.server.main', ['sbMaster' => true, 'sbActive' => 'data.kategori'])
@section('main-content')
   <a class="btn btn-dark" href="{{ route('admin.kategori.index') }}">
        <i class="fas fa-fw fa-arrow-left"></i>
        Back
    </a>
    
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-lg my-5">
                <div class="card-header">
                    <h1 class="h2 text-gray-800 text-center">{{ (isset($row->id)) ? 'Edit Kategori' : 'Kategori Baru' }}</h1>
                </div>
                <div class="card-body">
                    <form action="{{ isset($row->id) ? route('admin.kategori.update', $row->id) : route('admin.kategori.store') }}" method="POST">
                        @csrf
                        @if (isset($row->id)) @method('PUT') @endif
                        <div class="mb-3">
                            <label for="name_category" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name_category"
                                name="name_category" required value="{{ old('name_category', $row->name_category ?? '') }}">
                            @error('name_category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                                name="slug" value="{{ old('slug', $row->slug ?? '') }}">
                            @error('slug')
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
        const title = document.querySelector('#name_category');
                const slug = document.querySelector('#slug');
    
                title.addEventListener('change', function(){
                    fetch('/admin/manage_dashboard/kategori/checkSlug?title=' + title.value)
                    .then(response => response.json())
                    .then(data => slug.value = data.slug)
                });
    </script>
@endpush