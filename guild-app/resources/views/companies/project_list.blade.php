@extends('layouts.company')

@section('title', '')

@section('content')
<style>
    body {
        background-color: #F4EEE0;
    }
    .card{
        background-color: rgba(66, 66, 66, 0.8); /* 背景色を薄く */
        color: #F4EEE0;
        border-radius: 10px;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Simplify Your Hiring Process!</h1>
            <p class="mb-5">Stay organized and attract the right candidates. Streamline your hiring process to connect with top talent and build a reliable team.</p>
        </div>
        <div class="col-md-6">
            <h1>Keep track of your job posts and attract the best talent.</h1>
        </div>
    </div>

    @php
        // プロジェクト数が6未満の場合、空のオブジェクトで埋める
        $projects = array_pad($projects, 6, (object)[
            'deadline' => null,
            'title' => 'No Project Available',
            'reward_amount' => '-',
            'required_rank' => 0,
            'id' => null
        ]);
    @endphp
   <a href="{{ route('company.project')}}">create new job</a>
   <a href="{{ route('company.test.freelancer')}}">favorite freelancer</a>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach ($projects as $project)
        <div class="col">
            <div class="card border rounded p-3 shadow-sm h-100">
                <div class="row align-items-center">
                    <!-- First Column: Placeholder or Icon -->
                    <div class="col-2 d-flex justify-content-center">
                        <div class="border bg-light d-flex justify-content-center align-items-center" 
                            style="width: 50px; height: 50px; font-size: 0.9rem; font-weight: bold; color: #333;">
                            {{ $project->deadline ? \Carbon\Carbon::parse($project->deadline)->format('m/d') : '--/--' }}
                        </div>
                    </div>
                
                    <!-- Second Column: Title, Name, and Price -->
                    <div class="col-7">
                        <h2 class="fs-4 fw-bold text-dark mb-1">{{ $project->title }}</h2>
                        <div class="d-flex align-items-center mt-2">
                            <p class="mb-0 me-2 text-muted fw-bold">price : {{ $project->reward_amount }}</p>
                            @for ($i = 1; $i <= 5; $i++)
                            <label class="star {{ $i <= $project->required_rank ? 'text-warning' : 'text-muted' }}">★</label>
                            @endfor
                        </div>
                    </div>
                
                    <!-- Third Column: Status -->
                    <div class="col-3 d-flex align-items-center justify-content-center">
                        @if ($project->id)
                            <a href="{{ route('company.edit', $project->id) }}">edit</a>
                            <button data-bs-toggle="modal" data-bs-target="#delete-project-{{ $project->id }}">
                                detail
                            </button>
                            @include('companies.modal.delete')
                        @else
                            <p class="text-muted">No Actions Available</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
