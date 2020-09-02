<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('APP_name','Enga')}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .bottom-center {
                position: absolute;
                /* right: 590px; */
                bottom: 20px;
                width:100%;
            }

            @media (max-width:500px){
                .bottom-center {
                /* right: 70px; */
                right: 0px;
                bottom:35px;
                } 
            }
            @media (min-width:590px){
                .bottom-center {
                right: 0%;
                /* right: 40%; */
                } 
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .lang{
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .active{
                color:blue;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth

                    {{-- <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>{{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form> --}}
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Enga <sup style="font-size:15px;">2020</sup>
                </div>

                <div class="links">
                    <a href="#">Let's</a>
                    <a href="#">Get</a>
                    <a href="#">Your</a>
                    <a href="#">Body</a>
                    <a href="#">Mate</a>
                </div>
                {{-- <div class="bottom-center">
                    <span> <a class="lang {{App::getLocale() == 'ar' ? 'active':''}} " href="/setLang/ar">{{__('Arabic')}}</a></span>
                    <span> <a class="lang {{App::getLocale() == 'en' ? 'active':''}} " href="/setLang/en">{{__('English')}}</a></span>                    
                </div> --}}
            </div>
        </div>
    </body>
</html>
