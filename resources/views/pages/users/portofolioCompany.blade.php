@extends('layouts.client.master')

@section('master-content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <h1 class="section-title px-5 text-center mb-3"><span class="px-2">Portofolio Perusahaan</span></h1>
            <div class="col-lg-10 col-md-10">
                <div class="row justify-content-center">
                    @if ($datas->count())
                        @foreach ($datas as $item)
                            <div class="col-lg-4 col-md-4">
                                <div class="card rounded-lg">
                                    <div class="card-body">
                                        <h6 class="card-title text-danger">{{ $item->title_porto }}</h6>
                                        <p class="card-subtitle mb-2 text-muted"><em>{{$item->slug}}</em></p>
                                        <p class="card-text"><i class="fas fa-fw fa-calendar text-primary"></i> {{ $item->year }}</p>
                                        <a href="/portofolioCompany/detail/{{ $item->slug }}" class="card-link"><u>More Info</u></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-lg-6 col-md-6 col-sm-12 pb-1 mt-3 m-auto text-center">
                            <p class="fs-4 h3 mb-3">Maaf, Portofolio masih kosong!.</p>
                        </div>
                    @endif
                </div>
                <div class="row px-xl-5 pt-3 mr-2 justify-content-end">
                    {!! $datas->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection