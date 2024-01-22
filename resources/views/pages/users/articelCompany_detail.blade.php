@extends('layouts.client.master')
@section('master-content')
    <div class="container-fluid">
        <a href="/articelCompany" class="btn btn-dark rounded-pill ml-5"><i class="fas fa-arrow-alt-circle-left"></i> Kembali </a>
        <div class="row justify-content-center">
            <h1 class="section-title px-5 text-center mb-3"><span class="px-2">Detail Articel</span></h1>
            <div class="col-lg-10 col-md-10">
                <h6 class="text-center">By : {{ $data->user->name }}</h6>
                <div class="row mt-4">
                    <div class="col-lg col-md">
                        <h3 class="text-success">{{ $data->title }}</h3>
                        <div class="row justify-content-around">
                            <div class="col-lg-4 col-md-4">
                                <p class="m-0 ms-2 text-muted"> 
                                    <i class="fas fa-fw fa-user-alt text-primary"></i> {{ $data->user->name }}
                                </p>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <p class="m-0 text-muted ms-5"> <i class="fas fa-fw fa-clock text-danger"></i>
                                    {{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}
                                </p>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <a href="#"><i class="fab fa-whatsapp text-success fa-2x"></i></a>
                                <a href="#"><i class="fab fa-facebook text-primary fa-2x"></i></a>
                                <a href="#"><i class="fab fa-twitter text-primary fa-2x"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row justify-content-center mt-3">
                    <div class="col-lg-3 col-md-3 my-3">
                        @if($data->thumbnail)
                            <img src="{{ asset('storage/' . $data->thumbnail) }}" class="img-fluid rounded-lg" alt="img-thumbnail" />
                        @else
                            <img src="https://placehold.co/600x400" alt="img-thumbnail" />
                        @endif
                    </div>
                    @if($data->photo_articel)
                        @foreach ($data->photo_articel as $item)
                            <div class="col-lg-3 col-md-3 my-3">
                                <img src="{{ asset('storage/' . $item) }}" class="img-fluid rounded-lg" alt="img-thumbnail" />
                            </div>
                        @endforeach
                    @else 
                        <img src="https://placehold.co/600x400" alt="img-thumbnail" />
                    @endif
                </div>
                <div class="col-lg-12 col-md-12 mt-3">
                    <div class="card shadow-sm">
                        <div class="card-body m-sm-2">
                            <p class="card-text">{!! $data->content !!}</p>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <h3 class="section-title px-5 mb-3"><span class="px-2">More Articel</span></h3>
                    <div class="col-lg-12 col-md-12">
                        <div class="row">
                            @if(!$more_blog->isEmpty())
                                <div class="owl-carousel blog-carousel">
                                    @foreach ($more_blog as $key => $item)
                                        <div class="blog-item">
                                            <div class="col-md">
                                                <div class="card">
                                                    <div class="card-body">
                                                        @if ($item->thumbnail)
                                                            <img src="{{ asset('storage/' . $item->thumbnail) }}" class="img-fluid w-100 rounded-lg" alt="blog-img" />
                                                        @else
                                                            <img src="https://placehold.co/600x400" alt="img-thumbnail" />
                                                        @endif
                                                        <a href="{{ url('/articelCompany', $item->uuid) }}" class=" d-inline-block mt-3">{{ $item->title }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <h4 class="text-center my-5">Maaf, Artikel Masih Kosong !</h4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $('.blog-carousel').owlCarousel({
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