@extends('layouts.user-app')

@section('title', 'Edit ToDo')

@section('scripts')
    <script src="{{asset('js/todo.js')}}"></script>
@endsection

@section('content')
    <div class="row justify-content-center my-5">
        <div class="col-6">
            <div class=" border border-black rounded py-5 px-5 mb-3">
                <form action="{{route('freelancer.todo.store')}}" method="post">
                    @csrf

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <h3 class="mb-4 fw-bold">Edit To Do</h3>

                    <input type="hidden" name="deleted_todos" id="deleted_todos">
                    <div id="todo-list">
                        @foreach ($all_todos as $todo)
                        <div class="todo-item">
                            <label for="todo" class="form-label">To Do 1</label>
                            <div class="position-relative">
                                <input type="hidden" name="todos[{{$loop->index}}][id]" value="{{$todo->id}}">
                                <input type="text" name="todos[{{$loop->index}}][content]" class="form-control mb-4" value="{{$todo->content}}">
                                <button type="button" class="btn btn-sm remove-todo position-absolute end-0 top-50 translate-middle-y" data-id="{{$todo->id}}">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" id="add-todo" class="btn btn-secondary mt-3">Add</button>
                    <button type="submit" class="btn btn-dark w-100 mt-3">Update</button>
                </form>
            </div>
            <a href="{{route('freelancer.index', Auth::user()->id)}}" class="btn btn-secondary">≪ Back</a>
        </div>
    </div>
    @endsection
