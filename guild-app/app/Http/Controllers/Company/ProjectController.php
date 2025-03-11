<?php

namespace App\Http\Controllers\company;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Project;
use App\Models\Company;
use App\Models\Skill;
use App\Models\ProjectSkill;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
//project作成のためのpageに移動 
    public function index(){
        $skills = Skill::all();
        return view('companies.projects.create', compact('skills'));
    }

//projectの作成
    public function create(CompanyRequest $request){

        //create project table
        $project = project::create([
            'company_id' =>Auth::user()->company->id,
            'title' => $request->title,
            'description' =>$request->description,
            'required_rank'=>$request->required_rank,
            'deadline' => $request->deadline,
            'reward_amount'=> $request->reward_amount
        ]);

        //create projectSkill table
        if ($request->has('skill')) {
            foreach ($request->skill as $skill_id) {
                ProjectSkill::create([
                    'project_id' => $project->id,
                    'skill_id' => $skill_id,
                ]);
            }
        }

        //creates Skill table and projectSkill table.
        if ($request->has('else_skills')  && !empty($request->else_skills)) {
            $customSkill = Skill::create(['name' => $request->else_skills]);
            ProjectSkill::create([
                'project_id' => $project->id,
                'skill_id' => $customSkill->id,
            ]);
        }

        return redirect()->route('company.project.list');

    }


//projectの編集をするためのpageに移動
    public function edit($id){
        $project = Project::findOrFail($id);
        $skills = Skill::all();
// >>>>>>> upstream/main
        return view('companies.projects.edit', compact('skills','project'));
    }


//projectの編集
    public function update(CompanyRequest $request, $project_id){
        $project = Project::where('id',$project_id)->first();

        if(!$project){
            return redirect()->route('company.dashboard')->with('error', 'Project not found.');
        }

        $project->update([
            'company_id' =>Auth::user()->company->id,
            'title' => $request->title,
            'description' =>$request->description,
            'required_rank'=>$request->required_rank,
            'deadline' => $request->deadline,
            'reward_amount'=> $request->reward_amount
        ]);

        if($request->has('skill')){
            if(!Project::where('project_id',$project->id)){
                foreach($request->skill as $skill_id){
                     ProjectSkill::create([
                        'project_id' => $project_id,
                        'skill_id' => $request->skill_id
                     ]);
                }
            }else{
                ProjectSkill::where('project_id', $project_id)->delete();
                foreach($request->skill as $skill_id){
                    ProjectSkill::create([
                       'project_id' => $project_id,
                       'skill_id' => $skill_id
                    ]);
               }
            }

            if ($request->has('else_skills')  && !empty($request->else_skills)) {
                $customSkill = Skill::create(['name' => $request->else_skills]);
                ProjectSkill::create([
                    'project_id' => $project->id,
                    'skill_id' => $customSkill->id,
                ]);
            }

            return redirect()->route('company.project.list');

        }





        return redirect()->route('company.dashboard')->with('success','Project was edited');
    }


//projectのdelete
    public function delete($id){
        $project = Project::findOrFail($id);

        if(Auth::user()->company->id !== $project->company_id){
            return redirect()->route('company.dashboard')->with('no');
                }

        ProjectSkill::where('project_id', $project->id)->delete();

        $project->delete();

        return  redirect()->route('company.project.list');
    }







}


//project作成のためのpageに移動 
//projectの作成
//projectの編集をするためのpageに移動
//projectの編集
//projectのdelete