@extends('layouts.company')

@section('title', 'Create')

@section('content')
<div class=" in-4 border rounded-pill p-4 shadow-lg" style="background-color: #C976DE; ">
</div>
<div class=" in-5 border rounded-pill p-4 shadow-lg" style="background-color: #C976DE; ">
</div>
<div class=" in-6 border rounded-pill p-4 shadow-lg" style="background-color: #C976DE; ">
</div>
    <div class="create-container justify-center-content">
        <div class="card rounded  w-50 m-auto mt-3">

                

            <form action="#" method="post">
                @csrf
                <div class="mt-3 w-75 m-auto">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="input title">
                </div>

                <div class="mt-3 w-75 m-auto"">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="input title">
                </div>

                <div class="row w-75 m-auto">
                    <div class="col-6">
                        <div class="mt-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="input title">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mt-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="input title">
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
        
                <button type="submit" class="btn btn-secondary mt-3 mb-2" style="margin-left: 150px; padding: 0px 200px; ">submit</button>
                    
            </form>
        </div>
    </div>
@endsection