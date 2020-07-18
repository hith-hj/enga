<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- External styling --}}
    <link href="{{ asset('UI/css/sb-admin-2.min.css') }}" rel="stylesheet">   
    <link href="{{ asset('UI/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('UI/css/mycss.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animation.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastr.css') }}" rel="stylesheet">
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    @livewireStyles
    

</head>
<body id="page-top">
    <div>
        <main >
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('UI/vendor/jquery/jquery.min.js') }}" defer></script>
    <script src="{{ asset('UI/vendor/bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('UI/vendor/jquery-easing/jquery.easing.min.js') }}" defer></script>
    <script src="{{ asset('UI/js/sb-admin-2.min.js') }}" defer></script>
    <script src="{{ asset('UI/js/mine.js') }}" defer></script>
    <script src="{{ asset('UI/js/noti.js') }}" defer></script>
    <script src="{{asset('js/app.js')}}"></script>
    
    @livewireScripts
    {{-- @jquery --}}
    {{-- @toastr_js --}}
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/toastr.js')}}"></script>
    @toastr_render
</body>
</html>
