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
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block " style="background-color: blue;">
                            <a href="/">
                                <i class="fa fa-laugh-wink fa-wf fa-9x rotate-n-15" style="color:#fff; margin-top:30%;margin-left:35%;"></i>
                                <h2 style="color:#fff;margin-left:35%">
                                    Enga <small><sup>2020</sup></small>
                                </h2>
                            </a>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">{{__('lang.Welcome Back')}}!</h1>
                                </div>
                                <form class="user" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="{{__('lang.Email Address')}}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="{{__('lang.Password')}}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Remember Me</label>
                                        </div>
                                    </div> --}}
                                    {{-- <a href="index.html" class="btn btn-primary btn-user btn-block">Login </a> --}}
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        {{ __('lang.Login') }}
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="forgot-password.html">{{__('lang.Forgot Password')}}?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="{{route('register')}}">{{__('lang.Create an Account')}}!</a>
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
