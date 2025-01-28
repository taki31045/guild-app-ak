@extends('layouts.user-app')

@section('title', 'Edit ToDo')

@section('content')
    <div class="row justify-content-center">
        <div class="col-6 border border-black rounded py-5 px-5">
            <form action="#" method="post">
                @csrf
                <h3 class="mb-4 fw-bold">Edit To Do</h3>
                <label for="todo1" class="form-label">To Do 1</label>
                <input type="text" name="todo1" class="form-control mb-4" value="">

                <label for="todo2" class="form-label">To Do 2</label>
                <input type="text" name="todo1" class="form-control mb-4" value="">

                <label for="todo3" class="form-label">To Do 3</label>
                <input type="text" name="todo1" class="form-control mb-4" value="">

                <label for="todo4" class="form-label">To Do 4</label>
                <input type="text" name="todo1" class="form-control mb-4" value="">

                <label for="todo5" class="form-label">To Do 5</label>
                <input type="text" name="todo1" class="form-control mb-4" value="">

                <label for="todo6" class="form-label">To Do 6</label>
                <input type="text" name="todo1" class="form-control mb-4" value="">

                <label for="todo7" class="form-label">To Do 7</label>
                <input type="text" name="todo1" class="form-control mb-5" value="">

                <button type="submit" class="btn btn-dark w-100">Update</button>
            </form>
        </div>
    </div>
@endsection
