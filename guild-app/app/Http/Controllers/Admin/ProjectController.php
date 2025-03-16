<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Project;


class ProjectController extends Controller
{   
    public function getAllProjects(){
        $all_projects = Project::with(['company' => function ($query) {
            $query->withTrashed(); 
        }])
        ->withTrashed()->orderBy('id', 'asc')->paginate(4);

        return view('admins.project')
                ->with('all_projects', $all_projects);
    }
}