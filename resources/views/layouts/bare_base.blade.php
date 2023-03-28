<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        @yield('title')
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('static/frontend/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('static/frontend/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('static/frontend/css/style.css') }}">
    @stack('css')
</head>

<body class="">
    @yield('main')

    <script src="{{ asset('static/frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('static/frontend/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('static/frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('static/frontend/js/bootstrap.min.js') }}"></script>

    @stack('js')

</body>

</html>
