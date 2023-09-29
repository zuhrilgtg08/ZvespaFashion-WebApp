@extends('layouts.server.main', ['sbMaster' => true, 'sbActive' => 'data.spesifikasi'])

@section('main-content')
    <a class="btn btn-dark" href="{{ route('admin.spesifikasi.index') }}">
        <i class="fas fa-fw fa-arrow-left"></i>
        Back
    </a>

    <h3 class="my-4 text-gray-900">Detail Spesifikasi - ({{ $row->vespa->name_product }})</h3>

    <div class="row justify-content-center mb-3">
        <div class="col-xl-12 col-md-12">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-md-5">
                    @if ($row->vespa->thumbnail)
                        <img src="{{ asset('storage/' . $row->vespa->thumbnail) }}" alt="thumbnail" class="card-img-top rounded"
                            style="width: 100%; height: 100%; object-fit: cover;" />
                    @else
                        <img src="{{ asset('assets/dashboard/img/404.png') }}" alt="thumbnail" class="card-img-top rounded"
                            style="width: 100%; height: 100%; object-fit: cover;" />
                    @endif
                </div>
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