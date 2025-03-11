@extends('layouts.company')

@section('title', 'Recommended Freelancers')

@section('content')
<div class="container w-50 mt-5">
    <h1>Recommended Freelancers for {{ $project->title }}</h1>

    @if ($freelancers->isEmpty())
        <p>No recommended freelancers found.</p>
    @else
        <div class="row row-cols-1 row-cols-md-2 g-4 ">
            @foreach ($freelancers as $freelancer)
            <div class="col-6">
                <div class="card border rounded p-3 shadow-sm h-100">
                    <h2 class="fs-4 fw-bold text-dark mb-1">{{ $freelancer->user->name }}</h2>
                    <div class="col-6">
                        <p>  <?php
                            for($i = 1; $i <= $freelancer->rank; $i++){
                        ?>
                                <i class="fa-solid fa-star"></i>
                        <?php
                            }
                        ?></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
