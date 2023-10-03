@extends('layouts.server.main', ['sbMaster' => true, 'sbActive' => 'data.galeri'])

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
                    <form action="" method="POST" autocomplete="off">
                        @csrf
                        @method('PUT')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection