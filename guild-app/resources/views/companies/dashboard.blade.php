@extends('layouts.company')

@section('title', 'Dashboard')

@section('content')
    <div class="content row border w-75 m-auto">
        <div class="col-6">
            <div class=" in-1 border rounded-pill p-4" style="background-color: #C976DE;"></div>
            <br>
            <div class=" in-2 border rounded-pill p-4" style="background-color: #C976DE;"></div>
            <br>
            <div class="in-3 border rounded-pill p-4" style="background-color: #C976DE;"></div>
            <br>
           
        </div>
        <div class="col-6">
            <img src={{ asset('images/ae2944c609a05d17f8a8d016654bb03e.jpg') }} alt="Description" class="img-fluid" >
        </div>
    </div>
@endsection