@extends('layouts.server.main', ['sbMaster' => true, 'sbActive' => 'data.spesifikasi'])

@section('main-content')
    <a class="btn btn-dark" href="{{ route('admin.spesifikasi.index') }}">
        <i class="fas fa-fw fa-arrow-left"></i>
        Back
    </a>

    
    <div class="row justify-content-center">
        <div class="col-xl-11 col-lg-11">
            <div class="card border-0 shadow-lg my-5">
                <div class="card-header">
                    <h1 class="h2 text-gray-800 text-center">{{ (isset($row->id)) ? 'Edit Spesifikasi' : 'Buat Spesifikasi Vespa' }}</h1>
                </div>
                <div class="card-body">
                    <form action="{{ isset($row->id) ? route('admin.spesifikasi.update', $row->id) : route('admin.spesifikasi.store') }}" method="POST">
                        @csrf
                        @if (isset($row->id)) @method('PUT') @endif
                        <div class="col-xl-12 col-md-12">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="data_vespa" class="form-label">List Vespa</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fas fa-motorcycle"></i></span>
                                        </div>
                                        <select class="custom-select" name="product_id" id="data_vespa">
                                            <option selected disabled>Pilih Produk</option>
                                            @foreach ($vespa as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ isset($row->id) && $row->product_id == $item->id ? 'selected' : ''}}>
                                                        {{ $item->name_product }}
                                                    </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="engine" class="form-label">Input Engine</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fas fa-drum-steelpan"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('engine') is-invalid @enderror" 
                                            placeholder="engine" name="engine" id="engine" 
                                            value="{{ old('engine', $row->engine ?? '') }}" required />
                                        @error('engine')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="displacement" class="form-label">Input Displacement</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fas fa-luggage-cart"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('displacement') is-invalid @enderror" placeholder="displacement"
                                            name="displacement" id="displacement" value="{{ old('displacement', $row->displacement ?? '') }}" required />
                                        @error('displacement')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="max_power" class="form-label">Max Power</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fas fa-bolt"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('max_power') is-invalid @enderror" required
                                            placeholder="max power" name="max_power" id="max_power" value="{{ old('max_power', $row->max_power ?? '') }}" />
                                        @error('max_power')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="max_torque" class="form-label">Max Torque</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fas fa-air-freshener"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('max_torque') is-invalid @enderror" required placeholder="max torque"
                                            name="max_torque" id="max_torque" value="{{ old('max_torque', $row->max_torque ?? '') }}" />
                                        @error('max_torque')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="colling_system" class="form-label">Colling System</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fas fa-wind"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('colling_system') is-invalid @enderror" required placeholder="colling system"
                                            name="colling_system" id="colling_system" value="{{ old('colling_system', $row->colling_system ?? '') }}" />
                                        @error('colling_system')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="transmission" class="form-label">Transmission</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fab fa-gg-circle"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('transmission') is-invalid @enderror" required
                                            placeholder="transmission" name="transmission" id="transmission"
                                            value="{{ old('transmission', $row->transmission ?? '') }}" />
                                        @error('transmission')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="brake_system" class="form-label">Brake System</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fas fa-ring"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('brake_system') is-invalid @enderror" required
                                            placeholder="brake system" name="brake_system" id="brake_system"
                                            value="{{ old('brake_system', $row->brake_system ?? '') }}" />
                                        @error('brake_system')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="front_tire" class="form-label">Front Tire</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fas fa-cogs"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('front_tire') is-invalid @enderror" required
                                            placeholder="front tire" name="front_tire" id="front_tire"
                                            value="{{ old('front_tire', $row->front_tire ?? '') }}" />
                                        @error('front_tire')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="rear_tire" class="form-label">Rear Tire</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fas fa-wrench"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('rear_tire') is-invalid @enderror" required
                                            placeholder="rear tire" name="rear_tire" id="rear_tire"
                                            value="{{ old('rear_tire', $row->rear_tire ?? '') }}" />
                                        @error('rear_tire')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="type_model" class="form-label">Type Model</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fas fa-x-ray"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('type_model') is-invalid @enderror" required
                                            placeholder="type model" name="type_model" id="type_model"
                                            value="{{ old('type_model', $row->type_model ?? '') }}" />
                                        @error('type_model')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="fuel_capacity" class="form-label">Fuel Capacity</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon"><i class="fas fa-gas-pump"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('fuel_capacity') is-invalid @enderror" required
                                            placeholder="fuel capacity" name="fuel_capacity" id="fuel_capacity"
                                            value="{{ old('fuel_capacity', $row->fuel_capacity ?? '') }}" />
                                        @error('fuel_capacity')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 text-center">
                            <button type="submit" class="btn btn-primary w-25">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection