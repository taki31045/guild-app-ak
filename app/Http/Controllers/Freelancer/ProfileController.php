<?php

namespace App\Http\Controllers\Freelancer;
use App\Http\Controllers\Controller;
use App\Http\Requests\FreelancerProfileRequest;
use App\Models\Freelancer;
use App\Models\User;
use App\Models\Skill;
use App\Models\Transaction;
use Illuminate\Support\Facades\App;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function show($id){
        $user = User::findOrFail($id);
        $freelancer = $user->freelancer;

        $layout = match (Auth::user()->role_id) {
            1 => 'layouts.admin',      // 管理者
            2 => 'layouts.company',    // 企業
            3 => 'layouts.freelancer', // フリーランサー

        };

        $styles = match (Auth::user()->role_id) {
            1 => 'css/admins/freelancer-profile.css',      // 管理者
            2 => 'css/freelancer-profile.css',    // 企業
            3 => 'css/users/profile.css', // フリーランサー

        };

        if($freelancer){
            if($freelancer->evaluations()){
                $evaluations = $freelancer->evaluations()->get();
            }
            if($freelancer->applications()){
                $ongoingProjects  = $freelancer->applications()
                                                ->where('freelancer_id', $freelancer->id)
                                                ->where('status', '!=', 'completed')
                                                ->get();

            }
                $completedProjects  = Transaction::where('payee_id', $id)->with('project')->get();
                $favoriteProjects = $user->favoriteProjects()->get();
        }else{
            $evaluations = collect();
            $ongoingProjects = collect();
            $completedProjects = collect();
            $favoriteProjects = collect();
        }

        return view('freelancers.profile.show', compact('user', 'evaluations', 'ongoingProjects', 'completedProjects', 'favoriteProjects','layout','styles'));
    }


    public function edit($id){
        $user = User::findOrFail($id);
        $skills = Skill::all();

        return view('freelancers.profile.edit', compact('user', 'skills'));
    }


    public function update(FreelancerProfileRequest $request){

        $user = Auth::user();

        $user->update([
            'username' => $request->username,
            'name'     => $request->name,
            'email'    => $request->email,
        ]);

        if($request->avatar){
            $user->avatar = 'data:image/' . $request->avatar->extension() . ';base64,' . base64_encode(file_get_contents($request->avatar));
            $user->save();
        }

        $freelancer = $user->freelancer;
        if($freelancer){
            $freelancer->update([
                'github'    => $request->github,
                'X'         => $request->x,
                'instagram' => $request->instagram,
                'facebook'  => $request->facebook
            ]);
        }

        if($request->has('skills')){
            $skills = array_filter($request->skills, function($skill_id){
                return !is_null($skill_id) && $skill_id != '';
            });

            $freelancer->skills()->sync($skills);
        }else{
            $freelancer->skills()->detach();
        }
        return redirect()->route('freelancer.profile.show', $user->id);
    }
}
