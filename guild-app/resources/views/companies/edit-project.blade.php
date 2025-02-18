@extends('layouts.company')

@section('title', 'Edit')

@section('content')
<link href="{{ asset('css/companyedit.css') }}" rel="stylesheet">

<div class=" line-1 border rounded-pill p-4 shadow-lg" style="background-color: #C976DE; ">
</div>
<div class=" line-2 border rounded-pill p-4 shadow-lg" style="background-color: #C976DE; ">
</div>
<div class=" line-3 border rounded-pill p-4 shadow-lg" style="background-color: #C976DE; ">
</div>
    
    <div class="create-container justify-content-center mt-5">
        <div class="card rounded  w-50 m-auto mt-3 shadow-lg p-4 position-relative">
                <div class="text-center position-absolute top-0 start-50 translate-middle-x">
                    <h2 class="fw-bold my-3 h1">EDIT</h2>
                </div>  
            
            <form action="#" method="post">
                @csrf
                <div class="mt-5 w-75 m-auto">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" >
                </div>

                <div class="mt-3 w-75 m-auto">
                    <label for="title" class="form-label">Company name</label>
                    <input type="text" name="title" id="title" class="form-control" >
                </div>

                <div class="row w-75 m-auto">
                    <div class="col-6">
                        <div class="mt-3">
                            <label for="title" class="form-label">Price</label>
                            <input type="text" name="title" id="title" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mt-3">
                            <label for="title" class="form-label">Deadline</label>
                            <input type="text" name="title" id="title" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="mt-3 w-75 m-auto" >
                    <label for="required_skills" class="form-label d-block">required skills</label>
                    <input type="checkbox" class="btn-check" id="btn-check" >
                    <label class="btn btn-outline-secondary" for="btn-check">PHP</label>
                    
                    <input type="checkbox" class="btn-check" id="btn-check" >
                    <label class="btn btn-outline-secondary" for="btn-check">HTML</label>

                    <input type="checkbox" class="btn-check" id="btn-check" >
                    <label class="btn btn-outline-secondary" for="btn-check">CSS</label>
                        <input type="text" id="else_skills" class="form-control w-25 mt-2" placeholder="else skills">
                </div>

                <div class="mt-3 w-75 m-auto">

                    <label for="description" class="form-label ">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                </div>
        
                <button type="submit" class="btn btn-secondary mt-3 mb-2 w-75 d-block m-auto">update</button>
                    
            </form>
        </div>
    </div>
@endsection