<?php

namespace App\Http\Controllers\Freelancer;
use App\Http\Controllers\Controller;
use App\Http\Requests\FreelancerProfileRequest;
use App\Models\Freelancer;
use App\Models\User;
use App\Models\Skill;
use App\Models\Project;
use App\Models\FavoriteProject;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function show($id){
        $user = User::findOrFail($id);
        $freelancer = $user->freelancer;

        if($freelancer){
            if($freelancer->evaluations()){
                $evaluations = $freelancer->evaluations()->get();
            }
            if($freelancer->applications()){
                $ongoingProjects  = $freelancer->applications()
                                                ->where('freelancer_id', $freelancer->id)
                                                ->where('status', '!=', 'completed')
                                                ->get();

                $completedProjects  = $freelancer->applications()
                                                ->where('freelancer_id', $freelancer->id)
                                                ->where('status', 'completed')
                                                ->get();
            }
                $favoriteProjects = $user->favoriteProjects()->get();
        }else{
            $evaluations = collect();
            $ongoingProjects = collect();
            $completedProjects = collect();
            $favoriteProjects = collect();
        }

        return view('users.profile', compact('user', 'evaluations', 'ongoingProjects', 'completedProjects', 'favoriteProjects'));
    }


    public function edit($id){
        $user = User::findOrFail($id);
        $skills = Skill::all();

        return view('users.edit-profile', compact('user', 'skills'));
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
        return redirect()->route('freelancer.profile', $user->id);
    }
}
