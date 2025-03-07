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
    public function index(){//show page for create for new project
        $skills = Skill::all();
        return view('companies.create', compact('skills'));
    }


    public function create(CompanyRequest $request){//create project

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

        return redirect()->route('company.test');

    }



    public function edit($id){
        $project = Project::findOrFail($id);
// <<<<<<< HEAD
//         $skills = Skill::all();
// =======
        $skills = Skill::all();
// >>>>>>> upstream/main
        return view('companies.edit-project', compact('skills','project'));
    }


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

            return redirect()->route('company.dashboard');

        }





        return redirect()->route('company.dashboard')->with('success','Project was edited');
    }

    public function delete($id){
        $project = Project::findOrFail($id);

        if(Auth::user()->company->id !== $project->company_id){
            return redirect()->route('company.dashboard')->with('no');
                }

        ProjectSkill::where('project_id', $project->id)->delete();

        $project->delete();

        return  redirect()->route('company.dashboard');
    }







}
