<?php

namespace App\Http\Controllers\Company\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CompanyProfileRequest;


class ProfileController extends Controller
{

//profileのページに移動
    public function show($id){
        $user = User::with('company')->findOrFail($id);

    $company = $user->company;

    // `status` が 'completed' のプロジェクトのみ取得
    $projects = $company 
        ? $company->projects()->where('status', 'completed')->get()
        : collect();


    

        $layout = match (Auth::user()->role_id) {
            1 => 'layouts.admin',      // 管理者
            2 => 'layouts.company',    // 企業
            3 => 'layouts.freelancer', // フリーランサー

        };

        // このcompanyの持つprojectに紐づくfreelancer情報を取得
        $projectsWithFreelancers = $projects->map(function ($project) {
                
            $freelancerTransaction = $project->transactions()
                ->whereHas('payee', function ($query){
                    $query->where('role_id', 3);
                })
                ->first();

                $freelancer = optional($freelancerTransaction)->payee->username ?? 'N/A';

            // `$project` に `$freelancer_name` を追加
            $project->freelancer_name = $freelancer;
            return $project;

        });

        $transactions = Transaction::where('payer_id', $user->id)
                    ->orWhere('payee_id', $user->id)
                    ->with('project')
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('companies.profile.show', compact('company','user','projectsWithFreelancers','projects','transactions','layout'));
    }

//profileの編集
    public function edit($id){

        $user = User::findOrFail($id);

        $company = $user->company;

        if (Auth::id() !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('companies.profile.edit', compact('company','user'));
    }

    public function update(CompanyProfileRequest $request){

        $user = Auth::user();

        $companyName = $request->company_name;

        $user->update([
            'username' => $companyName,
            'name'     => $companyName,
            'email'    => $request->email,
        ]);

        if($request->avatar){
            $user->avatar = 'data:image/' . $request->avatar->extension() . ';base64,' . base64_encode(file_get_contents($request->avatar));
            $user->save();
        }

        $company = $user->company;

        $data = [
            'website'         => $request->website,
            'representative'  => $request->representative,
            'employee'        => $request->employee,
            'capital'         => $request->capital,
            'annualsales'     => $request->annualsales,
            'address'         => $request->address,
            'description'     => $request->description
        ];

        $company ? $company->update($data) : Company::create(array_merge($data, ['user_id' => $user->id]));

        return redirect()->route('company.profile.profile', $user->id);
    }
}


//profileの編集
//profileのページに移動
