@extends('layouts.user-app')

@section('title', 'Edit Profile')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/users/profile.css')}}">
@endsection

@section('scripts')
    <script src="{{asset('js/selected-language.js')}}"></script>
@endsection

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-6 border border-black rounded shadow py-5 px-5">
        <form action="#" method="post">
            @csrf
            <h3 class="mb-4 fw-bold">Edit Profile</h3>
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control mb-4" value="{{$user->username}}">

            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control mb-4" value="{{$user->name}}">


            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control mb-4  w-50" value="{{$user->email}}">

            <label for="github-id" class="form-label">Github ID</label>
            <input type="text" name="github_id" class="form-control mb-4 w-50" value="{{$user->freelancer->github}}">

            <label for="X" class="form-label">X</label>
            <input type="text" name="x" class="form-control mb-4 w-50" value="{{$user->freelancer->X}}">

            <label for="instagram" class="form-label">Instagram</label>
            <input type="text" name="instagram" class="form-control mb-4 w-50" value="{{$user->freelancer->instagram}}">

            <label for="facebook" class="form-label">Facebook</label>
            <input type="text" name="facebook" class="form-control mb-4 w-50" value="{{$user->freelancer->facebook}}">

            <div class="select-container">
                <label for="select-skill" class="form-label">Select your skills</label>
                <div class="custom-select" onclick="toggleDropdown()">
                    <span>Select Language</span>
                    <span>&#9660;</span>
                </div>
                <div class="dropdown">
                    <div data-value="" hidden>Please select skill</div>
                    <div data-value="HTML">HTML</div>
                    <div data-value="Python">Python</div>
                    <div data-value="CSS">CSS</div>
                    <div data-value="Javascript">Javascript</div>
                    <div data-value="PHP">PHP</div>
                    <div data-value="Ruby">Ruby</div>
                    <div data-value="C++">C++</div>
                    <div data-value="C#">C#</div>
                    <div data-value="Go">Go</div>
                    <div data-value="Java">Java</div>
                    <div data-value="Laravel">Laravel</div>
                    <div data-value="React.js">React.js</div>
                </div>
            </div>

            <div class="selected-tags"></div>
            <input type="hidden" name="languages" id="selectedLanguages">
            <button type="submit" class="btn btn-dark w-100 mt-4">Update</button>

            {{-- create new skill form --}}


        </form>
    </div>
</div>
@endsection
