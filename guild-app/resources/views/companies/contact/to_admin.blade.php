@extends('layouts.company')

@section('title', 'Contact')

@section('content')
<style>
    body{
        background-color: #F4EEE0;
    }
</style>
<div class="row justify-content-center my-5">
    <div class="col-6">
        <div class=" border border-black rounded py-5 px-5 mb-3">
            <form action="{{route('company.contact.send_to_admin')}}" method="Post" enctype="multipart/form-data">
                @csrf

                {{-- 成功メッセージ表示 --}}
                @if (session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                @endif
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

                <h3 class="mb-4 fw-bold">Contact Form</h3>

                <div id="contact-form">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control mb-4" value="{{old('name')}}">

                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control mb-4" value="{{old('title')}}">

                    <label for="content" class="form-label">Content</label>
                    <textarea name="content" rows="10" class="form-control  mb-4">{{old('content')}}</textarea>

                    <label for="attachment" class="form-label">Attach File (Optional)</label>
                    <input type="file" name="attachment" class="form-control mb-4">
                </div>
                <button type="submit" class="btn btn-dark w-100 mt-3">Send</button>
            </form>
        </div>
        <a href="{{route('company.project.on_going', Auth::user()->id)}}" class="btn btn-secondary">≪ Back</a>
    </div>
</div>
@endsection