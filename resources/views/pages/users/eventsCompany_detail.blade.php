@extends('layouts.client.master')
@section('master-content')
    <div class="container-fluid">
        <a href="/eventsCompany" class="btn btn-dark rounded-pill ml-5"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
        <div class="row justify-content-center">
            <h1 class="section-title px-5 text-center mt-5"><span class="px-2">Detail Infomation Events/Pameran Perusahaan</span></h1>
            <div class="col-lg-10 col-md-10">
                <div class="row mt-5">
                    <div class="col-lg-6 col-md-6 rounded">
                        <div id="product-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner border-0">
                                @if($row->photo_pameran)
                                    @foreach ($row->photo_pameran as $i => $img)
                                        <div class="carousel-item {{ ($i == 0) ? 'active' : '' }}">
                                            <img class="img-fluid" src="{{ asset('storage/' . $img) }}" alt="Image" style="min-width: 350px" />
                                        </div>
                                    @endforeach
                                @else
                                    <img src="{{ asset('assets/customer/img/event.jpg') }}" alt="Image" style="min-width: 350px" />
                                @endif
                            </div>
                            <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                                <i class="fa fa-2x fa-angle-left text-dark"></i>
                            </a>
                            <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                                <i class="fa fa-2x fa-angle-right text-dark"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h6 class="card-title"><span class="text-dark">Nama Event : </span>{{ $row->nama_pameran }}</h6>
                                <p class="card-text">{{ $row->slug }}</p>
                                <p class="card-text"><span>Description Event </span>{!! $row->description_event !!}</p>
                                <p class="card-text"><span class="text-dark">Date Event : </span>{{ date('D, M Y', strtotime($row->begin_event)); }}</p>
                                <p class="card-text"><span class="text-dark">Tempat Event : </span>{{ $row->place_event }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection