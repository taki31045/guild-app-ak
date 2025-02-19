@extends('layouts.user-app')

@section('title', 'Project List')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/users/project-list.css')}}">
@endsection

@section('scripts')
<script src="{{asset('js/favorite-project.js')}}"></script>
@endsection

@section('content')
    <div class="row justify-content-center job-list">
        <div class="col-8">
            <h2>JOB LIST</h2>

            {{-- Searching --}}

            @foreach ($all_projects as $project)
                <a href="{{route('freelancer.project-details', $project->id)}}" class="text-decoration-none text-dark">
                    <div class="job">
                        <div class="job-detail-container">
                            <div class="job-date">{{$project->deadline}}</div>
                            <div class="job-detail">
                                <h4>{{$project->title}}</h4>
                                <p class="fw-bold m-0">{{$project->company->user->name}}</p>
                                <p class="m-0">${{$project->reward_amount}}</p>
                                <p>
                                    <?php
                                        for($i = 1; $i <= $project->required_rank; $i++){
                                    ?>
                                            <i class="fa-solid fa-star"></i>
                                    <?php
                                        }
                                    ?>
                                </p>

                                @foreach ($project->skills as $skill)
                                    <span class="skill-tag">{{$skill->name}}</span>
                                @endforeach
                            </div>
                        </div>
                        <a class="favoriteBtn" data-url="{{route('freelancer.project.favorite', ['project' => $project->id])}}">
                            <i class="fa-heart fa-2x {{ $project->isFavorited() ? 'fa-solid' : 'fa-regular' }}"></i>
                        </a>
                    </div>
                </a>
            @endforeach


            {{-- paginate --}}
            <div class="d-flex justify-content-start">
                {{$all_projects->links()}}
            </div>

        </div>
    </div>
@endsection
