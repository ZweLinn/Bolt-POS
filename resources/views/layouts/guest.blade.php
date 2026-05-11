<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') === 'Laravel' ? 'Bolt POS' : config('app.name') }}</title>

        <!-- Custom fonts for this template-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
            integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
            .bg-login-image {
                background-image: url("{{ asset('user/img/banner-fruits.jpg') }}");
                background-size: cover;
                background-position: center;
            }
            .bg-register-image {
                background-image: url("{{ asset('user/img/hero-img.jpg') }}");
                background-size: cover;
                background-position: center;
            }
            .btn-github {
                color: #fff;
                background-color: #24292e;
                border-color: #fff;
            }
            .btn-github:hover {
                color: #fff;
                background-color: #1a1e22;
                border-color: #e6e6e6;
            }
            .btn-primary {
                background-color: #2563eb !important;
                border-color: #2563eb !important;
            }
            .btn-primary:hover {
                background-color: #1d4ed8 !important;
                border-color: #1d4ed8 !important;
            }
            .text-primary {
                color: #2563eb !important;
            }
        </style>
    </head>
    <body class="bg-slate-50">
        <div class="container">
            {{ $slot }}
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>
    </body>
</html>
