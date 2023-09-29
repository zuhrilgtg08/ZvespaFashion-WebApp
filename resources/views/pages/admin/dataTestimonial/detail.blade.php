@extends('layouts.server.main', ['sbMaster' => true, 'sbActive' => 'data.testimoni'])

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/vendor/swiper/swiper-bundle.min.css') }}"/>
    <style>
        .swiper-button-next, .swiper-button-prev {
            color: #1a1919;
        }

        .rate {
            display: inline-block;
            border: 0;
            margin-bottom: -20px;
        }
        
        .rate > input {
            display: none;
        }
      
        .rate > label {
            float: right;
        }
        
        .rate > label:before {
            display: inline-block;
            font-size: 1rem;
            font-style: normal;
            font-weight: 900;
            padding: 0 0 2rem .2rem;
            margin: 0;
            cursor: pointer;
            font-family: 'Font Awesome\ 5 Free';
            content: "\f005"; 
        }
        
        .rate .half:before {
            content: "\f089 "; 
            position: absolute;
            padding-right: 0;
        }
   
        input:checked ~ label { 
            color: #deb217; 
        } 
    </style>
@endpush

@section('main-content')
    <a class="btn btn-dark" href="{{ route('admin.testimoni.index') }}">
        <i class="fas fa-fw fa-arrow-left"></i>
        Back
    </a>
    
    <h3 class="my-4 text-gray-900">Data/Nilai Testimoni - ({{ $data[0]->nama_vespa }})</h3>

    <div class="row justify-content-center mb-3">
        <div class="swiper my-swiper">
            <div class="swiper-wrapper">
                @foreach ($data as $item)
                    <div class="swiper-slide">
                        <div class="col-xl-10 col-md-10">
                            <div class="card border-0 rounded">
                                <div class="row mx-auto my-3">
                                    <div class="col-md-3">
                                        @if ($item->profile)
                                            <img src="{{ asset('storage/' . $item->profile) }}" class="card-img-top rounded-circle rounded-md" alt="profile" />
                                        @else
                                            <img src="{{ asset('assets/dashboard/img/profile.svg') }}" class="card-img-top rounded-circle rounded-md" alt="profile" />
                                        @endif
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body">
                                            <h5 class="card-title text-success">{{ $item->email }}</h5> 
                                            <fieldset class="rate">
                                                <input type="radio" id="rating5" {{ ($item->rate == 5) ? 'checked' : null }}/><label for="rating5"></label>
                                                <input type="radio" id="rating4.5" {{ ($item->rate == 4.5 || $item->rate == 4.75 || $item->rate == 4.25) ? 'checked' : null }}/><label class="half" for="rating4.5"></label>
                                                <input type="radio" id="rating4" {{ ($item->rate == 4) ? 'checked' : null }}/><label for="rating4"></label>
                                                <input type="radio" id="rating3.5" {{ ($item->rate == 3.5 || $item->rate == 3.75 || $item->rate == 3.25) ? 'checked' : null }}/><label class="half" for="rating3.5"></label>
                                                <input type="radio" id="rating3" {{ ($item->rate == 3) ? 'checked' : null }}/><label for="rating3"></label>
                                                <input type="radio" id="rating2.5" {{ ($item->rate == 2.5) ? 'checked' : null }}/><label class="half" for="rating2.5"></label>
                                                <input type="radio" id="rating2" {{ ($item->rate == 2) ? 'checked' : null }}/><label for="rating2"></label>
                                                <input type="radio" id="rating1.5" {{ ($item->rate == 1.5) ? 'checked' : null }}/><label class="half" for="rating1.5"></label>
                                                <input type="radio" id="rating1" {{ ($item->rate == 1) ? 'checked' : null }}/><label for="rating1"></label>
                                                <input type="radio" id="rating0.5" {{ ($item->rate == 0.5) ? 'checked' : null }}/><label class="half" for="rating0.5"></label>
                                                ({{ $item->rate }})
                                            </fieldset>
                                            <p class="text-body">{!! $item->content !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
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
                delay:3000,
                disableOnInteraction: false,
            },
        });
    </script>
@endpush