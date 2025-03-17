@extends($layout)

@section('title', 'Project Details')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/users/project-details.css')}}">
@endsection

@section('content')
<div class="row justify-content-center mb-5">
    <div class="col-8">
        <div class="project-container">
            <div class="detail-container">
                <div class="job-header">
                    <h3>PROJECT DETAILS</h3>
                </div>
                <div class="details mt-5">
                    <div class="row">

                        <div class="col">
                            <h4 class="h5 fw-bold">{{$project->title}}</h4>
                            <p href="{{route('freelancer.company.profile.show', $project->company->user->id)}}" class="fw-bold m-0">{{$project->company->user->name}}</p>
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
                            <p>Deadline: {{$project->deadline}}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <h4>DESCRIPTION</h4>
                        <p>{!! nl2br(e($project->description)) !!}</p>
                    </div>
                    <h4 class="mb-3">REQUIRED SKILLS</h4>
                    @foreach ($project->skills as $skill)
                        <span class="skill-tag">{{$skill->name}}</span>
                    @endforeach

                    <hr>

                    <div class="detail-bottom">
                        {{-- back link --}}
                        <a href="{{url()->previous()}}" class="fs-2 back-link"><i class="fa-solid fa-hand-point-left me-2"></i>Go Back</a>

                        @if($application)
                            <div class="bottom-right">
                                @if ($application != null)
                                    @if ($application->submission_path && $application->project->company->id == Auth::user()->company->id)
                                        <a href="{{ route('company.project.download.file', $application->id) }}"><i class="fa-solid fa-download download-icon"></i></a>
                                    @endif
                                @endif
                                <button class="request-btn {{ $application->status }} bg-black bg-opacity-50">{{ ucfirst($application->status) }}</button>
                            </div>
                        @else
                            <button type="button" class="request-btn bg-black bg-opacity-50">
                                {{$project->status}}
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <div class="comment-container">
                <h4>Comments</h4>
                <div class="comments border border-black">
                    @foreach ($all_comments as $comment)
                        @if ($comment->user_id === Auth::user()->id)
                            <div class="message user">
                                <div class="bubble">
                                    {{$comment->content}}
                                </div>
                            </div>
                        @else
                            <div class="message other">
                                <div class="chat-icon">
                                    <a href="{{route('company.freelancer.profile.show', $comment->user->id)}}" class="fw-bold m-0">
                                        @if ($comment->user->avatar)
                                            <img src="{{$comment->user->avatar}}" alt="user id {{$comment->user->id}}" class="profile-icon">
                                        @else
                                            <i class="fa-solid fa-user-circle profile-icon"></i>
                                        @endif
                                    </a>
                                </div>
                                <div class="message-content">
                                    <div class="username">{{$comment->user->username}}</div>
                                    <div class="bubble">{{$comment->content}}</div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <form action="{{route('company.project.comment.store')}}" method="post" class="comment-form">
                    @csrf
                    <input type="hidden" name="id" value="{{$project->id}}">
                    <input type="text" name="content" class="comment-input" placeholder="Write a comment...">
                    <button type="submit" class="comment-btn">Send</button>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>
            </div>

            </div>
        </div>
    </div>
@endsection
