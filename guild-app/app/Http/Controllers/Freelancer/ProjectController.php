<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Project;
use App\Models\Application;
use App\Models\ProjectComment;
use Illuminate\Support\Facades\Auth;


class ProjectController extends Controller
{
    public function index(){
        $all_projects = Project::where('status', 'open')->latest()->paginate(6);
        return view('users.project-list', compact('all_projects'));
    }

    public function show($id){
        $project = Project::findOrFail($id);
        $all_comments = ProjectComment::where('project_id', $id)->get();

        if($project->application){
            $application = $project->application;
        }else{
            $application = collect();
        }

        return view('users.project-details', compact('project', 'all_comments', 'application'));
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

    // application status
    public function request($id){
        $project = Project::findOrFail($id);
        $project->status = 'ongoing';
        $project->save();

        Application::create([
            'freelancer_id' => Auth::user()->freelancer->id,
            'project_id'    => $id,
            'status'        => 'requested'
        ]);

        return redirect()->back();
    }

    public function cancelRequest($id){
        $application = Application::findOrFail($id);
        $project = $application->project;

        $project->status = 'open';
        $project->save();
        $application->delete();

        return redirect()->back();
    }

    public function start($id){
        $application = Application::findOrFail($id);
        $application->status = 'ongoing';
        $application->save();

        return redirect()->back();
    }

    public function rejectAcknowledge($id){
        $application = Application::findOrFail($id);
        $project = $application->project;

        $project->status = 'open';
        $project->save();
        $application->delete();

        return redirect()->back();
    }

    public function submit($id){
        $application = Application::findOrFail($id);
        $application->status = 'submitted';
        $application->save();

        return redirect()->back();
    }

    public function result($id){
        $application = Application::findOrFail($id);
        $project = $application->project;

        $user = Auth::user()->freelancer;
        $user->total_earnings += $project->reward_amount;
        $user->save();

        $application->status = 'completed';
        $application->save();
        $project->status = 'completed';
        $project->save();

        return redirect()->back();
    }
}
