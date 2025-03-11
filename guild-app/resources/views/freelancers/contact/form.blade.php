@extends('layouts.freelancer')

@section('title', 'Contact Form')

@section('content')
    <div class="row justify-content-center my-5">
        <div class="col-6">
            <a href="{{route('freelancer.index', Auth::user()->id)}}" class="text-decoration-none text-black fs-3"><i class="fa-solid fa-hand-point-left me-2"></i>Go Back</a>
            <div class=" border border-black rounded py-5 px-5 my-3">
                <form action="{{route('freelancer.contact.send')}}" method="Post" enctype="multipart/form-data">
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

        </div>
    </div>
@endsection
