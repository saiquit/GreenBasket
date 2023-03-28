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
                                <h3>{{ __('Set Password') }}</h3>
                                <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur
                                    adipisicing.</p>
                            </div>
                            <form method="POST" action="{{ route('auth.do_set_password') }}">
                                @csrf
                                <div class="form-group last mb-4">
                                    <label for="password">Password</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group last mb-4">
                                    <label for="password_confirmation">Password Confirmation</label>
                                    <input id="password_confirmation" type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        name="password_confirmation" required autocomplete="current-password">
                                </div>


                                <input type="submit" value="Log In" class="btn btn-block btn-primary">
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
