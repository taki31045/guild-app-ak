@extends('layouts.user-app')

@section('title', 'Edit Profile')

@section('content')
<div class="row justify-content-center">
    <div class="col-6 border border-black rounded shadow py-5 px-5">
        <form action="#" method="post">
            @csrf
            <h3 class="mb-4 fw-bold">Edit Profile</h3>
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control mb-4" value="">
            <div class="row">
                <div class="col-6">
                    <label for="first-name" class="form-label">First Name</label>
                    <input type="text" name="first_name" class="form-control mb-4" value="">
                </div>
                <div class="col-6">
                    <label for="last-name" class="form-label">Last Name</label>
                    <input type="text" name="last_name" class="form-control mb-4" value="">
                </div>
            </div>

            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control mb-4  w-50" value="">

            <label for="github-id" class="form-label">Github ID</label>
            <input type="text" name="github_id" class="form-control mb-4 w-50" value="">
            <label for="X" class="form-label">X</label>
            <input type="text" name="x" class="form-control mb-4 w-50" value="">
            <label for="facebook" class="form-label">Facebook</label>
            <input type="text" name="facebook" class="form-control mb-4 w-50" value="">

            <div class="row">
                <div class="col-6">
                    <label for="language" class="form-label">Skill</label>
                    <select id="language" name="language" class="form-select mb-5 h-75" multiple>
                        <option value="" selected hidden>Please select skill</option>
                        <option value="HTML">HTML</option>
                        <option value="Python">Python</option>
                        <option value="CSS">CSS</option>
                        <option value="Javascript">Javascript</option>
                        <option value="PHP">PHP</option>
                        <option value="Ruby">Ruby</option>
                        <option value="C++">C++</option>
                        <option value="C#">C#</option>
                        <option value="Go">Go</option>
                        <option value="Java">Java</option>
                        <option value="Laravel">Laravel</option>
                        <option value="React.js">React.js</option>
                    </select>
                </div>
                <div class="col-6 my-4">
                    <div id="selectedLanguage"></div>
                </div>
            </div>


            <script src="{{asset('js/selected-language.js')}}"></script>

            {{-- create new skill form --}}


            <button type="submit" class="btn btn-dark w-100 mt-4">Update</button>
        </form>
    </div>
</div>
@endsection
