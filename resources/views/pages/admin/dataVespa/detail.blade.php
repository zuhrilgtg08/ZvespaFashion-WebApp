@extends('layouts.server.main', ['sbMaster' => true, 'sbActive' => 'data.vespa'])

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/vendor/swiper/swiper-bundle.min.css') }}"/>
    <style>
        .swiper-button-next, .swiper-button-prev {
            color: #fff;
        }
    </style>
@endpush

@section('main-content')
    <a class="btn btn-dark" href="{{ route('admin.vespa.index') }}">
        <i class="fas fa-fw fa-arrow-left"></i>
        Back
    </a>
    <h3 class="my-4 text-gray-900">Detail Produk & Vespa - ({{ $row->name_product }})</h3>

    <div class="row justify-content-center mb-3">
        <div class="col-xl-6 col-md-6">
            @if ($row->thumbnail)
                <img src="{{ asset('storage/' . $row->thumbnail) }}" alt="thumbnail" class="card-img-top rounded"
                    style="width: 100%; height: 100%; object-fit: cover;"/>
            @else
                <img src="{{ asset('assets/dashboard/img/404.png') }}" alt="thumbnail" class="card-img-top rounded"
                    style="width: 100%; height: 100%; object-fit: cover;"/>
            @endif
        </div>
        <div class="col-xl-6 col-md-6">
            <div class="swiper my-swiper">
                <div class="swiper-wrapper">
                    @if ($row->photo_product)
                        @foreach ($row->photo_product as $item)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/' . $item) }}" alt="photo" class="card-img-top rounded"
                                    style="width: 100%; height: 100%; object-fit: cover;"/>
                            </div>
                        @endforeach
                    @else
                        <img src="{{ asset('assets/dashboard/img/404.png') }}" alt="photo" class="card-img-top rounded"
                            style="width: 100%; height: 100%; object-fit: cover;"/>
                    @endif
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
        <div class="col-xl-12 col-md-12 my-4">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-md-5">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <h6 class="font-weight-bold card-text text-gray-900">Kode : <span class="text-danger">{{ $row->uuid }}</span></h6>
                            <h6 class="font-weight-bold card-text text-gray-900">Stok Produk : <span class="text-danger">{{ $row->stock_product }} Produk</span></h6>
                            <h6 class="font-weight-bold card-text text-gray-900">Nomor Seri : <span class="text-success">{{ $row->nomor_seri }}</span></h6>
                            <h6 class="font-weight-bold card-text text-gray-900">Dibuat Tahun : {{ $row->launch_year }}</h6>
                            <h6 class="font-weight-bold card-text text-gray-900">Kategori : <span class="text-primary">{{ $row->category->name_category }}</span></h6>
                            <h6 class="font-weight-bold card-text text-gray-900">Harga Produk : <span class="text-primary">@currency($row->harga_product)</span></h6>
                            <h6 class="font-weight-bold card-text text-gray-900">Berat Produk : <span class="text-danger">{{ $row->weight_product / 1000 }} Kg</span></h6>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-md-7">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <h6 class="card-text text-gray-900">
                                {!! $row->detail_product !!}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-md-12">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-md-7">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <div class="row text-center">
                                    <li class="list-group-item text-gray-900">Engine : {{ $row->engine }}</li>
                                    <li class="list-group-item text-gray-900">Displacement : {{ $row->displacement }}</li>
                                    <li class="list-group-item text-gray-900">Max Power : {{ $row->max_power }}</li>
                                    <li class="list-group-item text-gray-900">Max Torque : {{ $row->max_torque }}</li>
                                    <li class="list-group-item text-gray-900">Colling System : {{ $row->colling_system }}</li>
                                    <li class="list-group-item text-gray-900">Brake System : {{ $row->brake_system }}</li>
                                    <li class="list-group-item text-gray-900">Front Tire : {{ $row->front_tire }}</li>
                                    <li class="list-group-item text-gray-900">Rear Tire : {{ $row->rear_tire }}</li>
                                    <li class="list-group-item text-gray-900">Type Model : {{ $row->type_model }}</li>
                                    <li class="list-group-item text-gray-900">Fuel Capacity : {{ $row->fuel_capacity }}</li>
                                    <li class="list-group-item text-gray-900">Transmission : {{ $row->transmission }}</li>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/dashboard/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script>
        var swiper = new Swiper(".my-swiper", {
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            loop: true,
            autoplay: {
                delay:5000,
                disableOnInteraction: false,
            },
        });
    </script>
@endpush