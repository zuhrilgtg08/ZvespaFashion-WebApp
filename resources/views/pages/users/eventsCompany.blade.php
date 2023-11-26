@extends('layouts.client.master')

@push('styles')
    <style>
        .modal.fade .modal-content {
            -webkit-transform: scale(0.7);
            -moz-transform: scale(0.7);
            -ms-transform: scale(0.7);
            transform: scale(0.7);
            opacity: 0;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            transition: all 0.3s;
        }
    
        .show.fade .modal-content {
            -webkit-transform: scale(1);
            -moz-transform: scale(1);
            -ms-transform: scale(1);
            transform: scale(1);
            opacity: 1;
        }
    </style>
@endpush

@section('master-content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <h1 class="section-title px-5 text-center mb-3"><span class="px-2">Events/Pameran Perusahaan</span></h1>
            <div class="col-lg-10 col-md-10 mt-5">
                <div class="row">
                    @foreach ($datas as $item)
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body">
                                    <h6 class="card-title">{{ $item->nama_pameran }}</h6>
                                    <p class="card-text text-primary">{{ $item->slug }}</p>
                                    <button type="button" href="#" class="btn btn-success rounded" data-toggle="modal" data-target="#detailModal">Selengkapnya</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Modal -->
                <div class="modal fade" id="detailModal" aria-labelledby="detailModal" aria-hidden="true" data-bakcdrop="static">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="detailModal">Detail Events</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item list-group-item-success"><span class="event-title"></span></li>
                                    <li class="list-group-item list-group-item-primary event-slug"></li>
                                    <li class="list-group-item"></li>
                                    <li class="list-group-item">A fourth item</li>
                                    <li class="list-group-item">And a fifth one</li>
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger rounded-pill w-25" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection