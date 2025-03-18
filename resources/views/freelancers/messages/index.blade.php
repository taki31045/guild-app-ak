@extends('layouts.freelancer')

@section('title', 'Freelancer Message')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/users/message.css')}}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-3 user-sidebar p-0">
            @foreach ($all_users as $user)
                <div class="user @if($user->id == $receiver->id) active-chat @endif">
                    <a href="{{route('freelancer.company.profile.show', $user->id)}}">
                        @if ($user->avatar)
                            <img src="{{$user->avatar}}" alt="user id {{$user->id}}" class="profile-icon">
                        @else
                            <i class="fa-solid fa-circle-user profile-icon"></i>
                        @endif
                    </a>
                    <a href="{{route('freelancer.messages.index', $user->id)}}">{{$user->username}}</a>
                </div>
            @endforeach
        </div>
        <div class="col-9 message-container">

            @if ($receiver->id == Auth::user()->id)
                <div class="none-message">
                    <i class="fa-regular fa-comment text-dark fa-4x"></i>
                    <h4>Your messages</h4>
                    <p class="text-secondary">Send a message to start a chat.</p>
                </div>
            @else
                <div class="message-header">
                    <h2>{{$receiver->username}}</h2>
                </div>
                <div class="message-content">
                    @foreach ($messages as $message)
                        @if ($message->sender_id == Auth::user()->id)
                            <div class="message user">
                                <div class="bubble">
                                    {{$message->content}}
                                </div>
                            </div>
                        @else
                            <div class="message other">
                                <div class="chat-icon">
                                    <a href="{{route('freelancer.company.profile.show', $user->id)}}">
                                        @if ($user->avatar)
                                            <img src="{{$user->avatar}}" alt="user id {{$user->id}}" class="profile-icon">
                                        @else
                                            <i class="fa-solid fa-circle-user profile-icon"></i>
                                        @endif
                                    </a>
                                </div>
                                <div class="bubble">
                                    {{$message->content}}
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="comment-form">
                    {{-- エラー表示 --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{route('freelancer.messages.store', $receiver->id)}}" method="post" class="w-100">
                        @csrf

                        <input type="hidden" name="receiver_id" value="{{$receiver->id}}">
                        <input type="text" name="content" class="comment-input" placeholder="Write a comment...">
                        <button type="submit" class="comment-btn">Send</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
