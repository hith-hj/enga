@extends('layouts.app')

<style>
    .bottom-center {
        position: absolute;
        /* right: 590px; */
        bottom: 20px;
        width:100%;
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
    .active{
        color:blue;
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
</style>
@section('content')

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5 mt-5">
                <div class="card-body p-0 ">
                    <div class="row">
                        <div class="col-lg-5 d-none d-lg-block " style="background-color: blue;">
                            <a href="/">
                                <i class="fa fa-laugh-wink fa-wf fa-9x rotate-n-15" style="color:#fff; margin-top:30%;margin-left:35%;"></i>
                                <h2 style="color:#fff;margin-left:32%">
                                    Enga <small><sup>2020</sup></small>
                                </h2>
                                <p style="color:#fff;margin-left:28%">Welcome aboard , Enjoy</p>
                            </a>
                        </div>
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">{{__('lang.Create an Account')}}</h1>
                                </div>
                                <form class="user" method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="form-group">
                                            <input type="text" name="name" class="form-control form-control-user  @error('name') is-invalid @enderror" 
                                            id="exampleLastName" placeholder="{{__('lang.Full Name')}}" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" 
                                        name="email" value="{{ old('email') }}" required autocomplete="email" id="exampleInputEmail" placeholder="{{__('lang.Email Address')}}">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                                            name="password" required autocomplete="new-password" id="exampleInputPassword" placeholder="{{__('lang.Password')}}">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <input id="password-confirm" type="password" class="form-control form-control-user" name="password_confirmation" 
                                            id="exampleRepeatPassword" placeholder="{{__('lang.Password')}}" required autocomplete="new-password">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        {{ __('lang.Register') }}
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{route('login')}}">{{__('lang.Already')}} | {{__('lang.Login')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>            
                </div>        
            </div>
            <div class="bottom-center">
                <span> <a class="lang {{App::getLocale() == 'ar' ? 'active':''}} " href="/setLang/ar">{{__('Arabic')}}</a></span>
                <span> <a class="lang {{App::getLocale() == 'en' ? 'active':''}} " href="/setLang/en">{{__('English')}}</a></span>                    
            </div>
        </div>
    </div>
</div>
@endsection
