<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CompanyProfileRequest;


class ProfileController extends Controller
{
    public function show($id){
        $user = User::with('company.projects')->findOrFail($id);

        $company = $user->company;
        $projects = $company ? $company->projects : collect();

        $layout = match (Auth::user()->role_id) {
            1 => 'layouts.admin',      // 管理者
            2 => 'layouts.company',    // 企業
            3 => 'layouts.freelancer', // フリーランサー

        };

        $transactions = Transaction::where('payer_id', $user->id)
                    ->orWhere('payee_id', $user->id)
                    ->with('project')
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('companies.profile', compact('company','user','projects','transactions','layout'));
    }

    public function edit($id){

        $user = User::findOrFail($id);

        $company = $user->company;

        if (Auth::id() !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('companies.edit-profile', compact('company','user'));
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

        return redirect()->route('company.profile', $user->id);
    }
}
