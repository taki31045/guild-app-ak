@extends('layouts.company')

@section('title', 'Paypal')

@section('content')

@if (session('error'))
<div>{{ session('error') }}</div>
@endif

@if (session('success'))
<div>{{ session('success') }}</div>
@endif

<a href="{{ route('company.paypal.payment') }}">PayPalで支払う</a>

@endsection