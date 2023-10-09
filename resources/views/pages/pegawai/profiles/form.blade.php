@extends('layouts.server.main', ['sbMaster' => true, 'sbActive' => 'data.profile'])

@section('main-content')
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-10">
            <div class="card border-0 shadow-lg my-5">
                <div class="card-header">
                    <h1 class="h2 text-gray-800 text-center">Tulis Isi Content Profile</h1>
                </div>
                <div class="card-body">
                    <form action="{{ isset($row->id) ? route('karyawan.update.form', auth()->user()->id) : route('karyawan.profile.store') }}" method="POST">
                        @csrf
                        @if (isset($row->id)) @method('PUT') @endif
                        <input type="hidden" name="karyawan_id" value="{{ auth()->user()->id }}"/>
                        <div class="row justify-content-center">
                            <div class="col-lg-12 mb-3">
                                <label for="about" class="form-label">Tulis Isi Tentang Content</label>
                                <input type="hidden" id="about" name="about" value="{{ old('about', $row->about ?? '') }}">
                                <trix-editor input="about"></trix-editor>
                                @error('about')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="visi" class="form-label">Tulis Visi Content</label>
                                <input type="hidden" id="visi" name="visi" value="{{ old('visi', $row->visi ?? '') }}">
                                <trix-editor input="visi"></trix-editor>
                                @error('visi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="misi" class="form-label">Tulis Misi Content</label>
                                <input type="hidden" id="misi" name="misi" value="{{ old('misi', $row->misi ?? '') }}">
                                <trix-editor input="misi"></trix-editor>
                                @error('misi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="my-3 mx-auto text-center">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-fw fa-check-circle"></i> Simpan
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
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        });
    </script>
@endpush