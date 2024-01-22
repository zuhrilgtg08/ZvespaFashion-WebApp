@extends('layouts.client.master')
@section('master-content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <h1 class="section-title px-5 text-center mb-3"><span class="px-2">About Us</span></h1>
            <div class="col-lg-10 col-md-10 mb-3">
                <img src="{{ asset('assets/customer/img/about-vespa.jpg') }}" alt="abput-us" class="img-fluid rounded"/>
            </div>
            <div class="col-lg-10 col-md-10 mb-5">
                <p class="text-gray-900 text-justify">{!! $data_about->about !!}</p>
            </div>
            <div class="col-lg-10 col-md-10">
                <h3 class="section-title px-5 mb-5"><span class="px-2">Galeri Produk Perusahaan</span></h3>
                <div class="row justify-content-center">
                    <div class="owl-carousel about-carousel">
                        @if($data_galeri->count())
                            @foreach ($data_galeri as $item)
                                <div class="about-item">
                                    <div class="col-md-12 col-sm-6">
                                        <div class="card h-100 border-0 rounded">
                                            @if ($item->photos)
                                                <img src="{{ asset('storage/' . $item->photos) }}" alt="img-galeri" class="card-img-top" />
                                            @else 
                                                <img src="{{ asset('assets/customer/img/blank-vespa.png') }}" alt="img-galeri" class="card-img-top" />
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h4 class="text-center my-5">Maaf, Galeri Belum ditambahkan!</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('.about-carousel').owlCarousel({
            loop: true,
            margin: 20,
            center:true,
            nav: false,
            autoplay: true,
            smartSpeed: 3000,
            responsive:{
                0:{
                    items:1
                },
                1200:{
                    items:3
                },
                576:{
                    items:5
                },
                768: {
                    items:6
                },
            }
        });
    </script>
@endpush