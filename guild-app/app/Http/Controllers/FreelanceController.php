<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Project;
use App\Models\Todo;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class FreelanceController extends Controller
{
    public function index(){
        $user = Auth::user();
        $freelancer = $user->freelancer;
        if($freelancer){
            $applications  = $freelancer->applications()
                                        ->where('status', '!=', 'completed')
                                        ->where('freelancer_id', $freelancer->id)
                                        ->get();
            $all_todos = Todo::where('freelancer_id', Auth::user()->freelancer->id)->get();
        }else{
            $applications = collect();

            $all_todos = collect();
            $freelancer = collect();
        }

        $latestProjects = Project::where('status', 'open')->latest()->take(6)->get();

        $monthlyEarnings = Transaction::where('payee_id', Auth::user()->id)
                                        ->whereMonth('created_at', Carbon::now()->month)
                                        ->sum('amount');

        return view('freelancers.dashboard.index', compact('user', 'freelancer', 'applications', 'all_todos', 'latestProjects', 'monthlyEarnings'));

    }

    public function editTodo(){
        $all_todos = Todo::where('freelancer_id', Auth::user()->freelancer->id)->get();
        return view('freelancers.todos.edit', compact('all_todos'));
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
