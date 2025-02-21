@extends('layouts.user-app')

@section('title', 'Project Details')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/users/project-details.css')}}">
@endsection

@section('scripts')
<script src="{{asset('js/favorite-project.js')}}"></script>
@endsection

@section('content')
    <div class="row justify-content-center mb-5">
        <div class="col-8">
            <div class="job-header">
                <h3>PROJECT DETAILS</h3>
                <a class="favoriteBtn" data-url="{{route('freelancer.project.favorite', ['project' => $project->id])}}">
                    <i class="fa-heart fa-2x {{ $project->isFavorited() ? 'fa-solid' : 'fa-regular' }}"></i>
                </a>
            </div>
            <div class="details mt-5">
                <div class="row">

                    <div class="col">
                        <h4 class="h5">{{$project->title}}</h4>
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
                        <p>Deadline: {{$project->deadline}}</p>
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <h4>DESCRIPTION</h4>
                    <div class="col-1"></div>
                    <div class="col">
                        <p>{{$project->description}}</p>
                    </div>
                </div>
                <h4 class="mb-3">REQUIRED SKILLS</h4>
                @foreach ($project->skills as $skill)
                    <span class="skill-tag">{{$skill->name}}</span>
                @endforeach

                <hr>

                <h4>Comments</h4>
                <div class="comments">
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
                                    <i class="fa-solid fa-user-circle fa-3x"></i>
                                </div>
                                <div class="message-content">
                                    <div class="username">{{$comment->user->username}}</div>
                                    <div class="bubble">{{$comment->content}}</div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <form action="{{route('freelancer.comment.store')}}" method="post" class="comment-form">
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

                <hr>

                <div class="detail-bottom">
                    {{-- back link --}}
                    <a href="{{route('freelancer.project.index')}}" class="btn btn-secondary">≪ Back</a>

                    <!-- Button trigger modal -->
                    @if ($project->status == 'open' && $project->required_rank <= Auth::user()->freelancer->rank)
                        <button type="button" class="request-btn" data-bs-toggle="modal" data-bs-target="#requestModal">
                            Request
                        </button>
                    @elseif($application && $application->freelancer->user->id == Auth::user()->id)
                        <button class="request-btn {{ $application->status }}" data-bs-toggle="modal" data-bs-target="#projectStatusModal-{{$application->id}}">{{ ucfirst($application->status) }}</button>
                        @include('users.modals.status')
                    @else
                        <button type="button" class="request-btn">
                            {{$project->status}}
                        </button>
                    @endif
                </div>

                @include('users.modals.request')

            </div>
        </div>
    </div>
@endsection
