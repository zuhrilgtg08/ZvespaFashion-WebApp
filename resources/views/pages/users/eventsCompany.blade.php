@extends('layouts.client.master')
@section('master-content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <h1 class="section-title px-5 text-center mb-3"><span class="px-2">Events/Pameran Perusahaan</span></h1>
            <div class="col-lg-10 col-md-10 mt-5">
                <div class="row">
                    @foreach ($datas as $item)
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <div class="card h-100 shadow-sm bg-primary rounded-lg text-white text-center">
                                <div class="card-body">
                                    <h5 class="card-title text-white">{{ $item->nama_pameran }}</h5>
                                    <hr class="border border-white">
                                    <p class="card-text">{{ $item->place_event }}</p>
                                    <a href="/eventsCompany/detail/{{ $item->slug }}" class="btn btn-danger rounded-pill mx-auto">Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection