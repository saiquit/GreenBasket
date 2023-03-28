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
                                <h3>{{ __('Verify Your Phone Number') }}</h3>
                                <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur
                                    adipisicing.</p>

                            </div>
                            <form method="post" action="{{ route('auth.do_phone_verification') }}">
                                @csrf
                                <div class="form-group first">
                                    <label for="v_number">{{ __('Verification Number') }}</label>
                                    <div class="input-group mb-3">
                                        <input id="v_number" type="v_number"
                                            class="form-control @isset($error) is-invalid @endisset"
                                            name="v_number" value="{{ old('v_number') }}" required aria-describedby="prefix"
                                            autocomplete="v_number" autofocus>
                                        <input type="hidden" name="user" value="{{ $user->id }}">
                                    </div>
                                    @isset($error)
                                        @if ($error)
                                            <div class="alert alert-danger">{{ $error }}</div>
                                        @endif
                                    @endisset

                                </div>

                                <input type="submit" value="{{ __('Verify') }}" class="btn btn-block btn-primary">
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
