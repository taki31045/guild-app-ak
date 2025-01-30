@extends('layouts.user-app')

@section('title', 'Freelancer Message')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/users/message.css')}}">
@endsection

@section('content')
    <div class="row justify-content-center px-5">
        <div class="col-3 user-sidebar">
            <div class="user">
                <i class="fa-solid fa-circle-user"></i>
                <h3>Ryunosuke</h3>
            </div>
        </div>
        <div class="col-9 message-container">
            <div class="message-header">
                <h2>Kredo Company</h2>
            </div>
            <div class="message-content">
                <div class="message user">
                    <div class="bubble">
                        Hello! I'm interested in this job.
                    </div>
                </div>

                <div class="message other">
                    <div class="chat-icon">
                        <i class="fa-solid fa-user-circle fa-3x"></i>
                    </div>
                    <div class="bubble">
                        Hello! I'm interested in this job.
                    </div>
                </div>

                <div class="message user">
                    <div class="bubble">
                        Hello! I'm interested in this job.
                    </div>
                </div>

                <div class="message other">
                    <div class="chat-icon">
                        <i class="fa-solid fa-user-circle fa-3x"></i>
                    </div>
                    <div class="bubble">
                        Hello! I'm interested in this job.
                        Hello! I'm interested in this job.
                        Hello! I'm interested in this job.
                        Hello! I'm interested in this job.
                        Hello! I'm interested in this job.
                        Hello! I'm interested in this job.
                        Hello! I'm interested in this job.
                        Hello! I'm interested in this job.
                    </div>
                </div>
                <div class="message user">
                    <div class="bubble">
                        Hello! I'm interested in this job.
                    </div>
                </div>
                <div class="message other">
                    <div class="chat-icon">
                        <i class="fa-solid fa-user-circle fa-3x"></i>
                    </div>
                    <div class="bubble">
                        Hello! I'm interested in this job.
                        Hello! I'm interested in this job.
                        Hello! I'm interested in this job.
                        Hello! I'm interested in this job.
                        Hello! I'm interested in this job.
                        Hello! I'm interested in this job.
                        Hello! I'm interested in this job.
                        Hello! I'm interested in this job.
                    </div>
                </div>
                <div class="message user">
                    <div class="bubble">
                        Hello! I'm interested in this job.
                    </div>
                </div>
                <div class="message other">
                    <div class="chat-icon">
                        <i class="fa-solid fa-user-circle fa-3x"></i>
                    </div>
                    <div class="bubble">
                        Hello! I'm interested in this job.
                        Hello! I'm interested in this job.
                        Hello! I'm interested in this job.
                        Hello! I'm interested in this job.
                        Hello! I'm interested in this job.
                        Hello! I'm interested in this job.
                        Hello! I'm interested in this job.
                        Hello! I'm interested in this job.
                    </div>
                </div>
                <div class="message user">
                    <div class="bubble">
                        Hello! I'm interested in this job.
                    </div>
                </div>

                <form action="#" method="post" class="comment-form">
                    <input type="text" class="comment-input" placeholder="Write a comment...">
                    <button type="submit" class="comment-btn">Send</button>
                </form>
            </div>
        </div>
    </div>
@endsection
