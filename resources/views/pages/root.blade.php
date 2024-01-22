@extends('layouts.client.master')
@section('master-content')
    <!-- Featured Start -->
        <div class="container-fluid pt-5">
            <div class="row px-xl-5 pb-3">
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                        <h1 class="text-primary m-0 mr-2"><i class="fas fa-check"></i></h1>
                        <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                        <h1 class="text-primary m-0 mr-2"><i class="fas fa-shipping-fast"></i></h1>
                        <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                        <h1 class="text-primary m-0 mr-3"><i class="fas fa-exchange-alt"></i></h1>
                        <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                       <h1 class="text-primary m-0 mr-3"><i class="fas fa-phone-volume"></i></h1>
                        <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
                    </div>
                </div>
            </div>
        </div>
    <!-- Featured End -->

    <!-- Categories Start -->
        <div class="container-fluid pt-5">
            <div class="text-center mb-4">
                <h2 class="section-title px-5"><span class="px-2">Kategori Pilihan</span></h2>
            </div>
            <div class="row px-xl-5 pb-3 justify-content-center">
                @foreach ($categories as $item)  
                    <div class="col-lg-2 col-md-6 pb-1">
                        <div class="cat-item d-flex flex-column mb-4" style="padding: 30px;">
                            <a href="/home?category={{ $item->slug }}" class="cat-img position-relative overflow-hidden mb-3">
                                <img class="img-fluid rounded" src="{{ asset('assets/customer/img/cate.svg') }}" alt="img-category">
                            </a>
                            <h5 class="font-weight-semi-bold m-0 text-center">{{ $item->name_category }}</h5>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    <!-- Categories End -->
    
    <!-- Offer Start -->
        <div class="container-fluid offer pt-5">
            <div class="row px-xl-5">
                <div class="col-md-6 pb-4">
                    <div class="position-relative bg-secondary text-center text-md-right text-white mb-2 py-5 px-5">
                        <img src="{{ asset('assets/customer/img/tes-v-2.png') }}" alt="img-offer"/>
                        <div class="position-relative" style="z-index: 1;">
                            <h5 class="text-uppercase text-primary mb-3">20% off the all order</h5>
                            <h2 class="mb-4 font-weight-semi-bold">Spring Collection</h2>
                            <a href="{{ route('popular.index') }}" class="btn btn-outline-primary rounded py-md-2 px-md-3">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pb-4">
                    <div class="position-relative bg-secondary text-center text-md-left text-white mb-2 py-5 px-5">
                        <img src="{{ asset('assets/customer/img/tes-v.png') }}" alt="img-offer"/>
                        <div class="position-relative" style="z-index: 1;">
                            <h5 class="text-uppercase text-primary mb-3">Dreaming in Colors</h5>
                            <h2 class="mb-4 font-weight-semi-bold">Winter Collection</h2>
                            <a href="{{ route('popular.index') }}" class="btn btn-outline-primary rounded py-md-2 px-md-3">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Offer End -->

    <!-- Products Start -->
        <div class="container-fluid pt-5">
            <div class="text-center mb-4">
                <h2 class="section-title px-5"><span class="px-2">Cari Semua di ZVespa Store!</span></h2>
            </div>
            <div class="row px-xl-5 pb-3">
                @if ($data->count())
                    @foreach ($data as $item)
                        <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                            <div class="card product-item shadow border-0 mb-4">
                                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    @if ($item->thumbnail)
                                        <img class="img-fluid w-100" src="{{ asset('storage/' . $item->thumbnail) }}" 
                                            alt="img-vespa" style="height: 200px;" />
                                    @else
                                        <img class="img-fluid w-100" src="{{ asset('assets/customer/img/blank-vespa.png') }}" 
                                            alt="img-vespa" style="height: 200px;" />
                                    @endif
                                </div>
                                <div class="card-body text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3">{{ $item->name_product }}</h6>
                                    <div class="d-flex justify-content-center">
                                        <h6>@currency($item->harga_product)</h6>
                                        <h6 class="text-muted ml-2"><del>@currency($item->harga_product * 2)</del></h6>
                                    </div>
                                    <span class="badge badge-success">{{ $str }}</span>
                                </div>
                                <div class="card-footer d-flex justify-content-between bg-light border">
                                    <a href="{{ route('detail.produk', $item->uuid) }}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>
                                        View Detail
                                    </a>
                                    <form action="{{ route('cart.store') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item->id }}"/>
                                        <input type="hidden" name="quantity" min="1" value="{{ ($item->stock_product > 0) ? 1 : 0 }}" max="{{ $item->stock_product }}"/>
                                        <button type="submit" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-danger mr-1"></i>
                                            Add To Cart
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-6 col-md-6 col-sm-12 pb-1 mt-3 m-auto text-center">
                        <p class="fs-4 h3 mb-3">Sory, Data Produk Tidak ada!.</p>
                    </div>
                @endif
            </div>
            <div class="row px-xl-5 pt-3 mr-2 justify-content-end">
                {!! $data->links() !!}
            </div>
        </div>
    <!-- Products End -->
@endsection