<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectComment;
use Illuminate\Support\Facades\Auth;


class ProjectController extends Controller
{
    public function index(){
        $all_projects = Project::where('status', 'open')->get();
        return view('users.project-list', compact('all_projects'));
    }

    public function show($id){
        $project = Project::findOrFail($id);
        $all_comments = ProjectComment::where('project_id', $id)->get();

        return view('users.project-details', compact('project', 'all_comments'));
    }


    public function store(CommentRequest $request){
        ProjectComment::create([
            'content'    => $request->content,
            'user_id'    => Auth::user()->id,
            'project_id' => $request->id
        ]);

        return redirect()->route('project-details', $request->id);
    }

    public function favorite(Project $project){
        $user = Auth::user();

        if($user->favoriteProjects()->where('project_id', $project->id)->exists()){
            $user->favoriteProjects()->detach($project->id);
            $favorite = false;
        }else{
            $user->favoriteProjects()->attach($project->id);
            $favorite = true;
        }

        return response()->json(['favorite' => $favorite]);
    }
}
