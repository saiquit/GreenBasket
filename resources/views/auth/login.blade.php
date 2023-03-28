@extends('layouts.auth.base')

@section('main')
    <div class="content min-vh-100 d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('static/frontend/images/login.png') }}" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h3>{{ __('Sign in') }}</h3>
                                <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur
                                    adipisicing.</p>
                            </div>
                            <form method="POST" action="{{ route('auth.do_login') }}">
                                @csrf
                                <div class="form-group first">
                                    <label for="username">Phone Number</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="prefix">+88</span>
                                        </div>
                                        <input id="phone" type="text"
                                            class="form-control @error('phone') is-invalid @enderror" name="phone"
                                            value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                                    </div>
                                    @error('phone')
                                        <span class="alert alert-danger w-100" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group last mb-4">
                                    <label for="password">Password</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="alert alert-danger w-100" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="d-flex mb-5 align-items-center">
                                    {{-- <label class="control control--checkbox mb-0"><span class="caption">Remember me</span> --}}
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                    <div class="control__indicator"></div>
                                    </label>
                                    <span class="ml-auto">
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link forgot-pass" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </span>
                                </div>
                                <input type="submit" value="Log In" class="btn btn-block btn-primary">
                                <p class="float-right"><a href="{{ route('auth.forgot_password') }}">Forget Password</a>
                                </p>
                                <p class="text-center">or</p>
                                <a class="btn btn-black btn-block" href="{{ route('auth.register', []) }}">Register</a>
                                {{-- <span class="d-block text-left my-4 text-muted">— or login with —</span> --}}
                                {{-- <div class="social-login">
                                    <a href="#" class="facebook">
                                        <span class="icon-facebook mr-3"></span>
                                    </a>
                                    <a href="#" class="twitter">
                                        <span class="icon-twitter mr-3"></span>
                                    </a>
                                    <a href="#" class="google">
                                        <span class="icon-google mr-3"></span>
                                    </a>
                                </div> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
