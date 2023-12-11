@extends('layouts.client.master')

@section('master-content')
    <div class="container-fluid">
        <a href="/portofolioCompany" class="btn btn-dark rounded-pill ml-5"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
        <div class="row justify-content-center">
            <h1 class="section-title px-5 text-center mb-3"><span class="px-2">Detail Portofolio</span></h1>
            <div class="col-lg-10 col-md-10">
                <div class="row justify-content-between">
                    <div class="col-lg-5 col-md-5 mb-3">
                        <div class="card rounded-lg">
                            @if ($row->image_porto)
                                <img src="{{ asset('storage/' . $row->image_porto) }}" class="card-img-top rounded-lg" alt="img-porto" 
                                    style="max-height: 300px; width: 100%; object-fit: cover; height: 100%;"/>
                            @else
                                <img src="{{ asset('assets/dashboard/img/404.svg') }}" class="card-img-top" alt="img-porto" />
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7">
                        <div class="card rounded-lg border-0">
                            <div class="card-body">
                                <h5 class="card-title">{{ $row->title_porto }}</h5>
                                <p class="card-text">{!! $row->description !!}</p>
                                <p class="card-text"><i class="text-danger fas fa-fw fa-calendar"></i> {{$row->year}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection