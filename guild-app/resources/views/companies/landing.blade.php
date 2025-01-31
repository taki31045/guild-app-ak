@extends('layouts.app')

@section('title', 'landing')

@section('content')
    <style>
        body{
            background-image: url("{{ asset('images/1.jpg')}}");
            background-size: cover;
        }


    </style>
    <div class="container" style="margin-top: 300px; margin-left: 230px;">
        <a href="#" class="border w-25 d-block bg-secondary text-black">register</a>
        <a href="#" class="border w-25 d-block mt-5 bg-secondary text-black">login</a>
    </div>
@endsection