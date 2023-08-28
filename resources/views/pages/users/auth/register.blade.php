@extends('layouts.client.master')
@section('master-content')
    <div class="container-fluid pt-3">
        <div class="row">
            <div class="container">
                <div class="row justify-content-center mx-auto">
                    <div class="col-xl-7 col-md-7 col-sm-7">
                        <img src="{{ asset('assets/customer/img/register.gif') }}" 
                            alt="img-register" class="img-fluid" />
                    </div>
                    <div class="col-xl-5 col-md-5 col-sm-5">
                        <div class="card border-0 mt-5">
                            <div class="card-body">
                                <form action="{{ route('register.store') }}" method="POST" autocomplete="off">
                                    @csrf
                                    <label for="name" class="form-label">Create Username</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="addon-input">
                                                <i class="fas fa-fw fa-tags text-dark"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control @error('text') is-invalid @enderror" name="name" id="name"
                                            value="{{ old('name') }}" required placeholder="Input Username" />
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <label for="email" class="form-label">Create Email Account</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="addon-input">
                                                <i class="fas fa-fw fa-envelope text-warning"></i>
                                            </span>
                                        </div>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                                            value="{{ old('email') }}" required placeholder="Email Address" />
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <label for="create-password" class="form-label">Create New Password</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fas fa-fw fa-key text-danger"></i></span>
                                        <input type="password" id="create-password" name="create_password" class="form-control @error('create_password') is-invalid @enderror"
                                            placeholder="Create Password" required />
                                            @error('create_password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                    </div>

                                    <label for="password" class="form-label">Confirm Password</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fas fa-fw fa-check-circle text-success"></i></span>
                                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                                            placeholder="Confirm Password" required />
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                    </div>

                                    <div class="mb-3 text-center">
                                        <button type="submit" class="btn btn-primary rounded w-50">
                                            <i class="fas fa-fw fa-arrow-alt-circle-right"></i>
                                            Sign up
                                        </button>
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