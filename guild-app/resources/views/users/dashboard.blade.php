@extends('layouts.user-app')

@section('title', 'Dashboard for Freelancer')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/users/dashboard.css')}}">
@endsection

@section('scripts')
    <script src="{{asset('js/favorite-project.js')}}"></script>
@endsection

@section('content')

    <div class="row justify-content-center mb-5">
        <div class="col-8">
            <h2>ON GOING</h2>
            @foreach ($ongoingProjects as $project)
                <a href="{{route('freelancer.project-details', $project->id)}}">
                    <div class="ongoing row mb-3">
                        <div class="col-1 bg-secondary">
                            <p>{{$project->project->deadline}}</p>
                        </div>
                        <div class="col">
                            <h3 class="h5 m-0">{{$project->project->title}}</h3>
                            <p class="fw-bold m-0">{{$project->project->company->user->name}}</p>
                            <p class="m-0">{{$project->project->reward_amount}}</p>
                            <p>
                                <?php
                                    for($i = 1; $i <= $project->project->required_rank; $i++){
                                ?>
                                        <i class="fa-solid fa-star"></i>
                                <?php
                                    }
                                ?>
                            </p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <div class="container">
        {{-- Left side --}}
        <div class="left-side">
            {{-- Profile --}}
            <div class="profile-sm">
                <a href="{{route('freelancer.profile', Auth::user()->id)}}">
                    @if ($user->avatar)
                        <img src="{{$user->avatar}}" alt="user id {{$user->id}}" class="profile-icon">
                    @else
                        <i class="fa-solid fa-circle-user fa-3x profile-icon"></i>
                    @endif
                </a>
                <div>
                    <h3>{{$user->username}}</h3>
                    <p>
                        @if ($freelancer)
                            <?php
                                for($i = 1; $i <= $freelancer->rank; $i++){
                            ?>
                                    <i class="fa-solid fa-star"></i>
                            <?php
                                }
                            ?>
                        @endif
                    </p>
                </div>
            </div>
            {{-- Todo List --}}
            <h3>ToDo List</h3>
            <div class="todo">
                <ul>
                    @foreach ($all_todos as $todo)
                        <li>{{$todo->content}}</li>
                    @endforeach
                </ul>
                <a href="{{route('freelancer.todo-edit')}}" class="text-black">
                    <i class="fa-solid fa-pen-to-square fa-2x"></i>
                </a>
            </div>
        </div>


        <div class="right-side">
            <h3>Recent Job</h3>
            <div class="suggested-job">
                @foreach ($latestProjects as $project)
                    <div class="job">
                        <div class="job-header">
                            <a href="{{route('freelancer.project-details', $project->id)}}" class="title">{{Str::limit($project->title, 40)}}</a>
                            <a class="favoriteBtn" data-url="{{route('freelancer.project.favorite', ['project' => $project->id])}}">
                                <i class="fa-heart fa-2x {{ $project->isFavorited() ? 'fa-solid' : 'fa-regular' }}"></i>
                            </a>
                        </div>

                        <a href="#" class="fw-bold m-0">{{$project->company->user->name}}</a>
                        <p class="m-0">{{$project->reward_amount}}</p>
                        <p>
                            <?php
                            for($i = 1; $i <= $project->required_rank; $i++){
                                ?>
                                <i class="fa-solid fa-star"></i>
                                <?php
                            }
                            ?>
                        </p>
                        <div class="skills">
                            @foreach ($project->skills as $skill)
                            <span class="skill-tag">{{$skill->name}}</span>
                            @endforeach
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
