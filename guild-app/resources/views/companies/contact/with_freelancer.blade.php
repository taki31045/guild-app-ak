@extends('layouts.company')

@section('title', 'Message')

@section('content')
<style>
       body {
        height: 100%;
        margin: 0;
        overflow: hidden; /* 画面全体のスクロールを防ぐ */
    }
</style>
    <div class="row">
        <div class="col-3" style="background-color: #e3d9c3; height: 800px; overflow-y: auto; padding-right: 10px;">
            @foreach ($all_users as $user_all)
            <div class="mt-2 d-flex align-items-start border-bottom border-black">
                <i class="fa-solid fa-circle-user fa-3x"></i>
                <a href="{{ route('company.contact.with_freelancer', $user_all->id )}}" class="mt-2 fs-5">{{ $user_all->name }}</a>
            </div>
            @endforeach
        </div>
        <div class="col-9" style="background-color: #F4EEE0">
            @if($user->id == Auth::user()->id)
                <div class="none-message">
                    <h1 class="border-bottom mt-3"  style="margin-left: 100px;">User name:</h1>
                    <div style="margin-top: 90px; overflow-y: auto;  height: 550px; padding-right: 10px; display:flex; justify-content:center; align-items: center;"> 
                        <div class="text-center">
                            <i class="fa-regular fa-comment text-dark fa-4x"></i>
                            <h4>Your messages</h4>
                            <p class="text-secondary">Send a message to start a chat.</p>
                            <a href="{{ route('company.freelancer.list')}}" class="btn btn-secondary">Send message</a>
                        </div>
                    </div>
                </div>
            @else
                <h1 class="border-bottom mt-3"  style="margin-left: 100px;">User name: {{ $user->name }}</h1>
                <div style="margin-top: 90px; overflow-y: auto;  height: 550px; padding-right: 10px;"> 
                    @foreach ($messages as $message)
                        @if ($message->sender_id == Auth::user()->id)
                            <div class=" d-flex align-items-start justify-content-end ">
                                <p class="border rounded-3 border-black me-3 shadow-lg border-2" style="max-width: 450px;">
                                    {{$message->content}}
                                </p>
                            </div>
                        @else
                            <div class=" d-flex align-items-start">
                                <i class="fa-solid fa-circle-user fa-3x"></i>
                                <p class="border rounded-3 border-black ms-3 shadow-lg border-2" style="max-width: 450px;">
                                    {{ $message->content}}
                                </p>
                            </div>
                        @endif
                    @endforeach
                </div>
                <form  action="{{route('company.contact.store', $user->id)}}" method="post">
                    @csrf
                    <div class="d-flex align-items-center justify-content-between">
                        <input type="hidden" name="receiver_id" value="{{$user->id}}">
                        <!-- Message input field -->
                        <input type="text" name="content" class="form-control w-100 m-2 rounded-pill py-2 px-3" placeholder="Type your message...">
                        
                        <!-- Submit button -->
                        <button type="submit" class="btn btn-secondary rounded-pill px-4 py-2 ">Send</button>
                    </div>
                </form>
            @endif
               

    </div>
@endsection