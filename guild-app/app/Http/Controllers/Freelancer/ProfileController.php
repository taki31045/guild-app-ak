<?php

namespace App\Http\Controllers\Freelancer;
use App\Http\Controllers\Controller;
use App\Http\Requests\FreelancerProfileRequest;
use App\Models\Freelancer;
use App\Models\User;
use App\Models\Skill;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show($id){
        $user = User::findOrFail($id);
        $freelancer = $user->freelancer;

        if($freelancer){
            $evaluations = $freelancer->evaluations()->get();

            $ongoingJobs  = $freelancer->applications()
                                            ->where('freelancer_id', $user->freelancer->id)
                                            ->where('status', 'ongoing')
                                            ->get();

            $completedJobs  = $freelancer->applications()
                                            ->where('freelancer_id', $user->freelancer->id)
                                            ->where('status', 'completed')
                                            ->get();
        }else{
            $evaluations = collect();
            $ongoingJobs = collect();
            $completedJobs = collect();
        }

        return view('users.profile', compact('user', 'evaluations', 'ongoingJobs', 'completedJobs'));
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
            'email'    => $request->email
        ]);

        $freelancer = $user->freelancer;
        if($freelancer){
            $freelancer->update([
                'github'    => $request->github,
                'X'         => $request->x,
                'instagram' => $request->instagram,
                'facebook'  => $request->facebook
            ]);
        }else{
            Freelancer::create([
                'user_id'   => $user->id,
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
