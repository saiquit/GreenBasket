<!DOCTYPE html>
<html lang="en">

<head>
    <title>Vegefoods - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('static/frontend/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('static/frontend/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('static/frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('static/frontend/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('static/frontend/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('static/frontend/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('static/frontend/css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('static/frontend/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('static/frontend/css/jquery.timepicker.css') }}">


    <link rel="stylesheet" href="{{ asset('static/frontend/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('static/frontend/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('static/frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('static/frontend/css/toastr.min.css') }}">>
    @stack('css')
</head>

<body class="goto-here">
    @include('layouts.auth.parts.nav')
    <!-- END nav -->
    @yield('main')

    @include('layouts.frontend.parts.footer')


    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen">
        <svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke="#3aaa35" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke-miterlimit="10" stroke="#F96D00" />
        </svg>
    </div>

    <script src="{{ asset('static/frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('static/frontend/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('static/frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('static/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('static/frontend/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('static/frontend/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('static/frontend/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('static/frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('static/frontend/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('static/frontend/js/aos.js') }}"></script>
    <script src="{{ asset('static/frontend/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('static/frontend/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('static/frontend/js/scrollax.min.js') }}"></script>
    <script src="{{ asset('static/frontend/js/toastr.min.js') }}"></script>
    <script src="{{ asset('static/frontend/js/main.js') }}"></script>
    <script>
        $(document).ready(function() {
            @if (Session::has('message'))
                var type = "{{ Session::get('alert-type', 'info') }}"
                switch (type) {
                    case 'info':
                        toastr.info("{{ Session::get('message') }}");
                        break;
                    case 'success':
                        toastr.success("{{ Session::get('message') }}");
                        break;
                    case 'warning':
                        toastr.warning("{{ Session::get('message') }}");
                        break;
                    case 'error':
                        toastr.error("{{ Session::get('message') }}");
                        break;
                }
            @endif
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    toastr.error('{{ $error }}');
                @endforeach
            @endif
        });
    </script>
    @stack('js')

</body>

</html>
