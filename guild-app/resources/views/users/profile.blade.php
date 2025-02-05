@extends('layouts.user-app')

@section('title', 'Show Freelancer Profile')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/users/profile.css')}}">
@endsection

@section('content')

<div class="profile-container">
    <div class="profile">
        <div class="profile-left">
            <i class="fa-solid fa-user-circle profile-icon"></i>
            <div class="rank">
                <span class="stars">
                    @if ($user->freelancer->rank === 1)
                        ⭐️
                    @elseif($user->freelancer->rank === 2)
                        ⭐️⭐️
                    @elseif($user->freelancer->rank === 3)
                        ⭐️⭐️⭐️
                    @elseif($user->freelancer->rank === 4)
                        ⭐️⭐️⭐️⭐️
                    @elseif($user->freelancer->rank === 5)
                        ⭐️⭐️⭐️⭐️⭐️
                    @endif
                </span>
            </div>
        </div>
        <div class="profile-right">
            <div class="profile-card">
                <div class="profile-header">
                    <h3>Profile</h3>
                    <a href="{{route('freelancer.profile-edit', $user->id)}}" class="text-black">
                        <i class="fa-solid fa-pen-to-square edit-icon"></i>
                    </a>
                </div>
                <div class="profile-content mb-3">
                    <table class="detail">
                        <tr>
                            <th class="pe-5">Username</th>
                            <td>{{$user->username}}</td>
                        </tr>
                        <tr>
                            <th class="pe-5">Name</th>
                            <td>{{$user->name}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$user->email}}</td>
                        </tr>
                        <tr>
                            <th>github</th>
                            <td>{{$user->freelancer->github}}</td>
                        </tr>
                        <tr>
                            <th>X</th>
                            <td>{{$user->freelancer->X}}</td>
                        </tr>
                        <tr>
                            <th>Instagram</th>
                            <td>{{$user->freelancer->instagram}}</td>
                        </tr>
                        <tr>
                            <th>Facebook</th>
                            <td>{{$user->freelancer->facebook}}</td>
                        </tr>
                    </table>
                </div>

                <h5>Skills</h5>
                <div class="skills">
                    @foreach ($user->freelancer->skills as $skill)
                        <span class="skill-tag">{{$skill->name}}</span>
                    @endforeach
                </div>
            </div>

            <div class="evaluation-container">
                <h4>Evaluation</h4>
                <div class="evaluation-item">
                    <span class="evaluation-title">Quality</span>
                    <div class="evaluation-bar">
                        <div class="progress" style="width: {{$evaluations->avg('quality') * 20}}%">{{$evaluations->avg('quality') * 20}}%</div>
                    </div>
                </div>
                <div class="evaluation-item">
                    <span class="evaluation-title">Communication</span>
                    <div class="evaluation-bar">
                        <div class="progress" style="width: {{$evaluations->avg('communication') * 20}}%">{{$evaluations->avg('communication') * 20}}%</div>
                    </div>
                </div>
                <div class="evaluation-item">
                    <span class="evaluation-title">Adherence</span>
                    <div class="evaluation-bar">
                        <div class="progress" style="width: {{$evaluations->avg('adherence') * 20}}%">{{$evaluations->avg('adherence') * 20}}%</div>
                    </div>
                </div>
                <div class="evaluation-item">
                    <span class="evaluation-title">Total</span>
                    <div class="evaluation-bar">
                        <div class="progress" style="width: {{$evaluations->avg('total') * 20}}%">{{$evaluations->avg('total') * 20}}%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="job-container">
    <input type="radio" id="job-history" name="tab-group" checked>
    <input type="radio" id="on-going" name="tab-group">
    <input type="radio" id="likes" name="tab-group">

    <div class="tab-menu">
        <label for="job-history" class="tab-label">Job History</label>
        <label for="on-going" class="tab-label">On Going</label>
        <label for="likes" class="tab-label">Likes Job</label>
    </div>

    <div class="tab-content">
        @foreach ($completedJobs as $completedJob)
            <a href="/job-details" class="text-decoration-none text-black">
                <div class="tab-pane job-history">
                    <div class="job-date">{{$completedJob->project->deadline}}</div>
                    <div class="job-details">
                        <h3 class="h5 m-0">{{$completedJob->project->title}}</h3>
                        <p class="fw-bold m-0">{{$completedJob->project->company->user->name}}</p>
                        <p class="m-0">{{$completedJob->project->reward_amount}}</p>
                        <p>
                            <?php
                                for($i = 1; $i <= $completedJob->project->required_rank; $i++){
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

        @foreach ($ongoingJobs as $ongoingJob)
            <a href="/job-details" class="text-decoration-none text-black">
                <div class="tab-pane on-going">
                    <div class="job-date">{{$ongoingJob->project->deadline}}</div>
                    <div class="job-details">
                        <h3 class="h5 m-0">{{$ongoingJob->project->title}}</h3>
                        <p class="fw-bold m-0">{{$ongoingJob->project->company->user->name}}</p>
                        <p class="m-0">{{$ongoingJob->project->reward_amount}}</p>
                        <p>
                            <?php
                                for($i = 1; $i <= $ongoingJob->project->required_rank; $i++){
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

        @foreach ($ongoingJobs as $ongoingJob)
            <a href="/job-details" class="text-decoration-none text-black">
                <div class="tab-pane likes">
                    <div class="job-date">{{$ongoingJob->project->deadline}}</div>
                    <div class="job-details">
                        <h3 class="h5 m-0">{{$ongoingJob->project->title}}</h3>
                        <p class="fw-bold m-0">{{$ongoingJob->project->company->user->name}}</p>
                        <p class="m-0">{{$ongoingJob->project->reward_amount}}</p>
                        <p>
                            <?php
                                for($i = 1; $i <= $ongoingJob->project->required_rank; $i++){
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

@endsection
