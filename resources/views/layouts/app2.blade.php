<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'ENGA') }}</title>

    <!-- Styles -->

    <link rel="icon" type="image/png" href="form/images/icons/favicon.ico"/>

    <link href="{{ asset('form/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet">
    <link href="{{ asset('form/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('form/vendor/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('form/css/mycss.css') }}" rel="stylesheet">
    <link href="{{ asset('form/css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    
    <style >
        body{
             -ms-overflow-style: none; /* IE 11 */
         }
         ::-webkit-scrollbar{
             width: 10px;
         }
         @-moz-document {
             html,body{ scrollbar-width: 10px;}
         }
         
    </style>
    @livewireStyles
</head>
<body id="page-top">
    <div id="app">
        <main >
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('form/vendor/jquery/jquery.min.js') }}" defer></script>
    <script src="{{ asset('form/vendor/select2/select2.min.js') }}" defer></script>
    <script src="{{ asset('form/js/global.js') }}" defer></script> 
</body>
</html>
