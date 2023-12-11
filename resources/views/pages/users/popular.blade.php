@extends('layouts.client.master')
@section('master-content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <h1 class="section-title px-5 text-center mb-3"><span class="px-2">Produk Popular</span></h1>

            <div class="col-lg-10 col-md-10">
                @if($datas->count())
                    <div class="row pt-3">
                        @foreach ($datas as $item)
                            <div class="col-lg-3 col-md-3">
                                <div class="card shadow-sm rounded">
                                    @if($item->thumbnail)
                                        <img src="{{ asset('storage/' . $item->thumbnail) }}" width="200" class="card-img-top" alt="image-popular" style="width:100%;"/>
                                    @else
                                        <img src="{{ asset('assets/customer/img/blank-vespa.png') }}" class="card-img-top" alt="image-popular"/>
                                    @endif
                                    <div class="card-body text-center">
                                        <p class="card-text font-weight-bolder mb-0">{{ $item->name_product }}</p>
                                        <span class="card-text text-primary">@currency($item->harga_product)</span> |
                                        <span class="card-text text-danger font-weight-bolder">Stok : {{ $item->stock_product }}</span>
                                        <span class="card-text text-dark">{{ $item->rate }} <li class="fas fa-fw fa-star text-warning"></li></span>
                                        <p class="card-text fs-4">{{ $item->excerpt }}</p>
                                        <a href="{{ route('detail.produk', $item->uuid) }}" class="btn btn-outline-success btn-sm rounded">Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <h4 class="text-center my-5">Maaf, Produk Tidak ditemukan!</h4>
                @endif
            </div>
        </div>
    </div>
@endsection