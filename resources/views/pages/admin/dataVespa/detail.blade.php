@extends('layouts.server.main', ['sbMaster' => true, 'sbActive' => 'data.vespa'])
@section('main-content')
    <a class="btn btn-dark" href="{{ route('admin.vespa.index') }}">
        <i class="fas fa-fw fa-arrow-left"></i>
        Back
    </a>
    <h3 class="mt-4 text-gray-800">Detail Produk Vespa</h3>

    <div class="row justify-content-between mb-3">
        <div class="col-md-6">
            <div class="card border-0 shadow-lg">
                <div class="row">
                    <div class="col-md text-center shadow-inner m-auto">
                        @if ($row->thumbnail)
                            <img src="{{ asset('storage/' . $row->thumbnail) }}" alt="thumbnail" class="img-fluid rounded"
                                style="width: 100%; height: 100%; object-fit: cover;" />
                        @else
                            <img src="{{ asset('assets/dashboard/img/404.svg') }}" alt="thumbnail" class="img-fluid rounded"
                                style="width: 100%; height: 100%; object-fit: cover;" />
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-lg" style="max-width: 600px;">
                <div class="card-title bg-dark text-center">
                    <h5 class="text-light font-semibold my-3">{{ $row->name_product }}</h5>
                </div>
                <div class="card-body">
                    <p class="lead">
                       
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection