@extends('layouts.client.master')
@section('master-content')
    <div class="container-fluid pt-3">
        <div class="row">
            <div class="container">
                <div class="row justify-content-center mx-auto">
                    <div class="col-xl-5 col-md-5 col-sm-5">
                        <div class="card border-0 mt-5">
                            <div class="card-body">
                                <form action="{{ route('reset.password') }}" method="POST" autocomplete="off">
                                    @csrf
                                    <label for="email" class="form-label">Your Email Account</label>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="addon-input">
                                                <i class="fas fa-fw fa-envelope text-warning"></i>
                                            </span>
                                        </div>
                                        <input type="email" class="form-control @error('reset_email') is-invalid @enderror" name="reset_email" 
                                            id="email" value="{{ old('reset_email') }}" required placeholder="Email Address" autofocus/>
                                        @error('reset_email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <label for="password_new" class="form-label">Create New Password</label>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="addon-input">
                                                <i class="fas fa-fw fa-user-lock text-danger"></i>
                                            </span>
                                        </div>
                                        <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" id="password_new" required placeholder="Input New Password" />
                                        @error('new_password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                         @enderror
                                    </div>

                                    <label for="password" class="form-label">Confirm New Password</label>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="addon-input">
                                                <i class="fas fa-fw fa-check-circle text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" id="password" required placeholder="Confirm New Password" />
                                        @error('confirm_password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-4 text-center">
                                        <button type="submit" class="btn btn-danger rounded w-50">
                                            <i class="fas fa-fw fa-sign-in-alt"></i>
                                            Reset
                                        </button>
                                    </div>
                                </form>
                                <div class="row justify-content-center">
                                    <div class="col-md text-center" style="font-size: 11px;">   
                                        <p class="text-gray-600">Don't have an account?
                                            <a href="{{ route('register') }}" class="font-bold">Signup</a>
                                        </p>
                                    </div>
                                    <div class="col-md text-center" style="font-size: 11px;">
                                        <p class="text-gray-600">Have an account?
                                            <a href="{{ route('login') }}" class="font-bold">Signin</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection