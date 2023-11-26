@extends('layouts.client.master')

@push('styles')
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
            margin: 0;
        }
    </style>
@endpush

@section('master-content')
    <div class="container-fluid">
        <div class="row justify-content-center mb-5">
            <h1 class="section-title px-5 text-center mb-4"><span class="px-2">Detail Produk</span></h1>
        </div>
        <div class="row px-xl-5 justify-content-center"> 
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border-0">
                        @foreach ($row->photo_product as $key => $img)
                            <div class="carousel-item {{ ($key == 0) ? 'active' : '' }}">
                                <img class="img-fluid" src="{{ asset('storage/' . $img) }}" alt="Image" style="min-width: 350px"/>
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>
        
            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold">{{ $row->name_product }}</h3>
                <div class="d-flex mb-3">
                    <div class="text-warning mr-2">
                        @foreach ($row->testimoni as $item)
                            @while($item->rate > 0)
                                @if($item->rate > 0.5)
                                    <small class="fas fa-star"></small>
                                @else
                                    <small class="fas fa-star-half-alt"></small>
                                @endif

                                @php $item->rate--; @endphp
                            @endwhile
                        @endforeach
                    </div>
                    <small class="pt-1">({{ $row->testimoni->count() }} Reviews)</small>
                </div>
                <h3 class="font-weight-semi-bold mb-4">@currency($row->harga_product)</h3>
                <p class="mb-4">{!! $row->detail_product !!}</p>
                <form>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="number" max="{{ $row->stock_product }}" class="form-control bg-secondary text-center" min="1" value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Information</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">Specifications</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Reviews ({{ $row->testimoni->count() }})</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3">Product Information</h4>
                        <p>{!! $row->detail_product !!}</p>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-2">
                        <h4 class="mb-3">Additional Specifications</h4>
                        <div class="row">
                            @foreach ($row->specifications as $spec)
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">{{ $spec->engine }}</li>
                                        <li class="list-group-item px-0">{{ $spec->displacement }}</li>
                                        <li class="list-group-item px-0">{{ $spec->max_power }}</li>
                                        <li class="list-group-item px-0">{{ $spec->max_torque }}</li>
                                        <li class="list-group-item px-0">{{ $spec->rear_tire }}</li>
                                        <li class="list-group-item px-0">{{ $spec->fuel_capacity }}</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">{{ $spec->colling_system }}</li>
                                        <li class="list-group-item px-0">{{ $spec->transmission }}</li>
                                        <li class="list-group-item px-0">{{ $spec->brake_system }}</li>
                                        <li class="list-group-item px-0">{{ $spec->front_tire }}</li>
                                        <li class="list-group-item px-0">{{ $spec->type_model }}</li>
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-4">More review for "{{ $row->name_product }}"</h4>
                                @foreach ($row->testimoni as $rev)
                                    <div class="media mb-4">
                                        @if($rev->customer->profile_image)
                                            <img src="{{ asset('storage/' . $rev->customer->profile_image) }}" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;" />
                                        @else
                                            <img src="{{ asset('assets/dashboard/img/profile.svg') }}" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;" />
                                        @endif
                                        <div class="media-body">
                                            <h6>{{ $rev->customer->name }}<small> - <i>{{ $rev->customer->created_at->diffForHumans() }}</i></small></h6>
                                            <div class="text-primary mb-2">
                                                @while($all_rev > 0)
                                                    @if($all_rev > 0.5)
                                                        <small class="fas fa-star"></small>
                                                    @else
                                                        <small class="fas fa-star-half-alt"></small>
                                                    @endif
                                                    @php $all_rev--; @endphp
                                                @endwhile
                                            </div>
                                            <p>{{ $rev->content }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-md-6">
                                <h4 class="mb-4">Leave a review</h4>
                                <small>Your email address will not be published. Required fields are marked *</small>
                                <form>
                                    <div class="d-flex my-3">
                                        <p class="mb-0 mr-2">Your Rating * :</p>
                                        <div class="text-primary mb-2">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="message">Your Review *</label>
                                        <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Your Name *</label>
                                        <input type="text" class="form-control" id="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Your Email *</label>
                                        <input type="email" class="form-control" id="email">
                                    </div>
                                    <div class="form-group mb-0">
                                        <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection