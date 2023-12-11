@extends('layouts.client.master')

@push('styles')
    <style>
        @import url("https://use.fontawesome.com/releases/v5.13.0/css/all.css");
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
            margin: 0;
        }

        .rate {
            display: inline-block;
            border: 0;
        }
        
        .rate > input {
            display: none;
        }
      
        .rate > label {
            float: right;
        }
        
        .rate > label:before {
            display: inline-block;
            font-size: 2rem;
            font-style: normal;
            font-weight: 900;
            padding: .3rem .2rem;
            margin: 0;
            cursor: pointer;
            font-family: "Font Awesome 5 Free";
            content: "\f005"; 
        }
        
        .rate .half:before {
            content: "\f089"; 
            position: absolute;
            padding-right: 0;
        }
        
   
        input:checked ~ label, 
        label:hover, label:hover ~ label 
        { color: #deb217; } 
        
        input:checked + label:hover, input:checked ~ label:hover, 
        input:checked ~ label:hover ~ label, 
        label:hover ~ input:checked ~ label 
        { color: #c59b08; }
    </style>
@endpush

@section('master-content')
    <div class="container-fluid">
        <a href="{{ route('home') }}" class="btn btn-dark rounded-pill ml-5"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
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
                        @if ($row->testimoni->count())
                            @while($all_rev > 0)
                                @if($all_rev > 0.5)
                                    <small class="fas fa-star"></small>
                                @else
                                    <small class="fas fa-star-half-alt"></small>
                                @endif
                                    @php $all_rev--; @endphp
                            @endwhile
                        @else
                            <small class="fas fa-fw fa-star"></small>
                        @endif
                    </div>
                    <small class="pt-1">({{ $row->testimoni->count() }} Reviews)</small>
                </div>
                <h3 class="font-weight-semi-bold mb-4">@currency($row->harga_product)</h3>
                <p class="mb-4">{{ $desc_short }}</p>
                <form action="{{ route('cart.store') }}" method="POST" class="d-inline">
                    @csrf
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <input type="hidden" name="product_id" value="{{ $row->id }}" />
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="number" name="quantity"
                                    class="form-control bg-secondary @error('quantity') is-invalid @enderror text-center" 
                                    min="1" 
                                    max="{{ $row->stock_product }}" 
                                    value="{{ old('quantity', ($row->stock_product > 0) ? '1' : '0') }}" />
                            @error('quantity')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
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
                            @if ($row->specifications->count())
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
                            @else
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">Spesifikasi belum ditambahkan</li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-4">More review for "{{ $row->name_product }}"</h4>
                                @if ($row->testimoni->count())
                                    @foreach ($row->testimoni as $rev)
                                        <div class="media mb-4">
                                            @if($rev->customer->profile_image)
                                                <img src="{{ asset('storage/' . $rev->customer->profile_image) }}" alt="Image" class="img-fluid mr-3 mt-1"
                                                    style="width: 45px;" />
                                            @else
                                                <img src="{{ asset('assets/dashboard/img/profile.svg') }}" alt="Image" class="img-fluid mr-3 mt-1"
                                                    style="width: 45px;" />
                                            @endif
                                            <div class="media-body">
                                                <h6>{{ $rev->customer->name }}<small> - <i>{{ $rev->customer->created_at->diffForHumans() }}</i></small></h6>
                                                <div class="text-primary mb-2">
                                                    ({{ $rev->rate }}) <small class="fab fa-twitter"></small>
                                                </div>
                                                <p>{{ $rev->content }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-md mb-4">Testimoni belum ditambahkan</div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <h4 class="mb-4">Leave a review</h4>
                                <small>Your email address will not be published. Required fields are marked *</small>
                                <form action="{{ route('ratings.add') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $row->id }}" />
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" />
                                     @if (!$reviews->isEmpty())
                                        <fieldset class="rate">
                                            @foreach ($reviews as $item)
                                                <input type="radio" id="rating5" name="rate" value="5" {{ ($item->rate == 5) ? 'checked' : null }}/><label for="rating5"></label>
                                                <input type="radio" id="rating4.5" name="rate" value="4.5" {{ ($item->rate == 4.5) ? 'checked' : null }}/><label class="half" for="rating4.5"></label>
                                                <input type="radio" id="rating4" name="rate" value="4" {{ ($item->rate == 4) ? 'checked' : null }}/><label for="rating4"></label>
                                                <input type="radio" id="rating3.5" name="rate" value="3.5" {{ ($item->rate == 3.5) ? 'checked' : null }}/><label class="half" for="rating3.5"></label>
                                                <input type="radio" id="rating3" name="rate" value="3" {{ ($item->rate == 3) ? 'checked' : null }}/><label for="rating3"></label>
                                                <input type="radio" id="rating2.5" name="rate" value="2.5" {{ ($item->rate == 2.5) ? 'checked' : null }}/><label class="half" for="rating2.5"></label>
                                                <input type="radio" id="rating2" name="rate" value="2" {{ ($item->rate == 2) ? 'checked' : null }}/><label for="rating2"></label>
                                                <input type="radio" id="rating1.5" name="rate" value="1.5" {{ ($item->rate == 1.5) ? 'checked' : null }}/><label class="half" for="rating1.5"></label>
                                                <input type="radio" id="rating1" name="rate" value="1" {{ ($item->rate == 1) ? 'checked' : null }}/><label for="rating1"></label>
                                                <input type="radio" id="rating0.5" name="rate" value="0.5" {{ ($item->rate == 0.5) ? 'checked' : null }}/><label class="half" for="rating0.5"></label>
                                            @endforeach
                                        </fieldset>
                                        <div class="form-group">
                                            <label for="message">Your Review *</label>
                                            <textarea id="message" name="content" cols="30" rows="5" class="form-control" required
                                                placeholder="Leave Coments...">{{ old('content', $komentar) }}</textarea>
                                        </div>
                                    @else
                                        <fieldset class="rate">
                                            <input type="radio" id="rating5" name="rate" value="5" /><label for="rating5"></label>
                                            <input type="radio" id="rating4.5" name="rate" value="4.5" /><label class="half" for="rating4.5"></label>
                                            <input type="radio" id="rating4" name="rate" value="4" /><label for="rating4"></label>
                                            <input type="radio" id="rating3.5" name="rate" value="3.5" /><label class="half" for="rating3.5"></label>
                                            <input type="radio" id="rating3" name="rate" value="3" /><label for="rating3"></label>
                                            <input type="radio" id="rating2.5" name="rate" value="2.5" /><label class="half" for="rating2.5"></label>
                                            <input type="radio" id="rating2" name="rate" value="2" /><label for="rating2"></label>
                                            <input type="radio" id="rating1.5" name="rate" value="1.5" /><label class="half" for="rating1.5"></label>
                                            <input type="radio" id="rating1" name="rate" value="1" /><label for="rating1"></label>
                                            <input type="radio" id="rating0.5" name="rate" value="0.5" /><label class="half" for="rating0.5"></label>
                                        </fieldset>
                                        <div class="form-group">
                                            <label for="message">Your Review *</label>
                                            <textarea id="message" name="content" cols="30" rows="5" class="form-control" required
                                                placeholder="Leave Coments...">{{ old('content') }}</textarea>
                                        </div>
                                    @endif
                                    <div class="mb-0">
                                        <button type="submit" class="btn btn-primary px-3 rounded-pill">Leave Your Review</button>
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