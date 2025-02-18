<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Todo;

class FreelanceController extends Controller
{
    public function index(){
        $user = Auth::user();
        $freelancer = $user->freelancer;
        if($freelancer){
            $ongoingProjects  = $freelancer->applications()
                                                    ->where('freelancer_id', $freelancer->id)
                                                    ->where('status', 'ongoing')
                                                    ->get();
            $all_todos = Todo::where('freelancer_id', Auth::user()->freelancer->id)->get();
        }else{
            $ongoingProjects = collect();
            $all_todos = collect();
            $freelancer = collect();
        }


        $latestProjects = Project::where('status', 'open')->latest()->take(8)->get();

        return view('users.dashboard', compact('user', 'freelancer', 'ongoingProjects', 'all_todos', 'latestProjects'));
    }

    public function editTodo(){
        $all_todos = Todo::where('freelancer_id', Auth::user()->freelancer->id)->get();
        return view('users.edit-todo', compact('all_todos'));
    }

    public function store(TodoRequest $request){
        $todos = $request->todos ?? [];

        foreach($todos as $todoData){
            if(!empty($todoData['id'])){
                $todo = Todo::findOrFail($todoData['id']);
                if($todo){
                    $todo->content = $todoData['content'];
                    $todo->save();
                }
            }elseif(!empty($todoData['content'])){
                Todo::create([
                    'freelancer_id' => Auth::user()->freelancer->id,
                    'content' => $todoData['content']
                ]);
            }
        }

        if($request->filled('deleted_todos')){
            $deletedIds = explode(',', $request->input('deleted_todos'));
            Todo::whereIn('id', $deletedIds)->delete();
        }

        return redirect()->route('freelancer.index');
    }
}
