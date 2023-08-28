@extends('layouts.client.master')
@section('master-content')
    <div class="container-fluid pt-3">
        <div class="row">
            <div class="container">
                <div class="row justify-content-center mx-auto">
                    <div class="col-xl-7 col-md-7 col-sm-7">
                        <img src="{{ asset('assets/customer/img/login.gif') }}" alt="img-login" 
                            class="img-fluid"/>
                    </div>
                    <div class="col-xl-5 col-md-5 col-sm-5">
                        <div class="card border-0 mt-5">
                            <div class="card-body">
                                <form action="{{ route('login.authenticate') }}" method="POST" autocomplete="off">
                                    @csrf
                                    <label for="email" class="form-label">Your Email Account</label>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="addon-input">
                                                <i class="fas fa-fw fa-envelope text-warning"></i>
                                            </span>
                                        </div>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" 
                                            id="email" value="{{ old('email') }}" required placeholder="Email Address" />
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <label for="password" class="form-label">Your Password</label>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="addon-input">
                                                <i class="fas fa-fw fa-user-lock text-danger"></i>
                                            </span>
                                        </div>
                                        <input type="password" class="form-control" name="password" id="password"
                                            required placeholder="Input Password" />
                                    </div>

                                    <div class="mb-4 text-center">
                                        <button type="submit" class="btn btn-success rounded w-50">
                                            <i class="fas fa-fw fa-sign-in-alt"></i>
                                            Sign in
                                        </button>
                                    </div>
                                </form>
                                <div class="text-center text-lg fs-3">
                                    <p class="text-gray-600">Don't have an account?
                                        <a href="{{ route('register') }}" class="font-bold">Signup</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection