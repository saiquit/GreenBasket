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
                                <h3>{{ __('Register') }}</h3>
                                <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur
                                    adipisicing.</p>
                            </div>
                            <form action="{{ route('auth.do_register') }}" method="post">
                                @csrf
                                <div class="form-group first">
                                    <label for="phone">{{ __('Phone Number') }}</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="prefix">+88</span>
                                        </div>
                                        <input id="phone" type="phone"
                                            class="form-control @error('phone') is-invalid @enderror" name="phone"
                                            value="{{ old('phone') }}" required aria-describedby="prefix"
                                            autocomplete="phone" autofocus>
                                    </div>

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <input type="submit" value="{{ __('Register') }}" class="btn btn-block btn-primary">
                                <p class="text-center">or</p>
                                <a class="btn btn-black btn-block" href="{{ route('auth.login', []) }}">Login</a>
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
