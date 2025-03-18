@extends('layouts.freelancer')

@section('title', 'Dashboard for Freelancer')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/users/dashboard.css')}}">
@endsection

@section('scripts')
    <script src="{{asset('js/favorite-project.js')}}"></script>
    <script src="{{asset('js/submitWork.js') }}"></script>
@endsection

@section('content')

    <div class="row justify-content-center mb-5">
        <div class="col-8">
            <h2>ON GOING</h2>

            @if ($applications->isEmpty())
                <div class="alert alert-secondary text-center mt-3">
                    <i class="fa-solid fa-circle-info me-2"></i> No ongoing projects available.
                </div>
            @else
                @foreach ($applications as $application)
                    <div class="ongoing">
                        <div class="ongoing-box">
                            <div class="Project-date">{{ \Carbon\Carbon::parse($application->project->deadline)->format('m/d') }}</div>
                            <div class="Project-details">
                                <a href="{{route('freelancer.projects.show', $application->project->id)}}" class="fs-5">
                                    {{$application->project->title}}
                                </a>

                                <a href="{{route('freelancer.company.profile.show', $application->project->company->user->id)}}" class="fw-bold m-0">{{$application->project->company->user->name}}</a>
                                <p class="m-0">{{$application->project->reward_amount}}</p>
                                <p>
                                    <?php
                                        for($i = 1; $i <= $application->project->required_rank; $i++){
                                    ?>
                                            <i class="fa-solid fa-star"></i>
                                    <?php
                                        }
                                        ?>
                                </p>
                            </div>
                        </div>

                        {{-- status --}}
                        {{-- requested, accepted, rejected, ongoing, submitted, resulted, completed --}}
                        <div class="project-status">
                            <button class="status-label {{ $application->status }}" data-bs-toggle="modal" data-bs-target="#projectStatusModal-{{$application->id}}">{{ ucfirst($application->status) }}</button>
                        </div>
                        @include('freelancers.dashboard.modal.status')
                    </div>
                @endforeach
            @endif

        </div>
    </div>

    <div class="container">
        {{-- Left side --}}
        <div class="left-side">
            {{-- Profile --}}
            <div class="profile-sm">
                <a href="{{route('freelancer.profile.show', Auth::user()->id)}}">
                    @if ($user->avatar)
                        <img src="{{$user->avatar}}" alt="user id {{$user->id}}" class="profile-icon">
                    @else
                        <i class="fa-solid fa-circle-user profile-icon"></i>
                    @endif
                </a>
                <div class="profile-details">
                    <h3>{{$user->username}}</h3>
                    <p>
                        Rank:
                        @if ($freelancer)
                            @for($i = 1; $i <= $freelancer->rank; $i++)
                                <i class="fa-solid fa-star"></i>
                            @endfor
                        @endif
                    </p>
                    <p>Ongoing Projects: <strong>{{$applications->count()}} items</strong></p>
                    <p>Earnings This Month: <strong>${{$monthlyEarnings}}</strong></p>
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
                <a href="{{route('freelancer.todos.edit')}}" class="text-black">
                    <i class="fa-solid fa-pen-to-square fa-2x edit-icon"></i>
                </a>
            </div>
        </div>


        <div class="right-side">
            <h2>Recent Projects</h2>
            <div class="suggested-job">
                @foreach ($latestProjects as $project)
                    <div class="job">
                        <div class="job-header">
                            <a href="{{route('freelancer.projects.show', $project->id)}}" class="title">
                                {{Str::limit($project->title, 40)}}
                            </a>
                            <a class="favoriteBtn" data-url="{{route('freelancer.projects.favorite', ['project' => $project->id])}}">
                                <i class="fa-heart fa-2x {{ $project->isFavorited() ? 'fa-solid' : 'fa-regular' }}"></i>
                            </a>
                        </div>

                        <a href="{{route('freelancer.company.profile.show', $project->company->user->id)}}" class="fw-bold m-0">{{$project->company->user->name}}</a>
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
