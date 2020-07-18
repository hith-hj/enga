@extends('layouts.app')
@section('content')
    <user-chat :cid=30 :uid={{Auth::user()->id}} :rid=46 ></user-chat>  
@endsection
