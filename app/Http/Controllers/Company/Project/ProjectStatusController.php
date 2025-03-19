<?php

namespace App\Http\Controllers\Company\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Application;
use App\Models\Project;

class ProjectStatusController extends Controller
{
     //ongoingのrequested時のdecline
     public function decline(Request $request){
        $project_id = $request->query('id');
        Application::where('project_id', $project_id)->delete();
        Project::where('id',$project_id)->update(['status'=>'open']);

        return redirect()->route('company.project.on_going');
    }

    public function submittedDecline(Request $request){
        $project_id = $request->query('id');
        Application::where('project_id',$project_id)->update(['status'=>'ongoing']);

        return redirect()->route('company.project.on_going');
    }
}
