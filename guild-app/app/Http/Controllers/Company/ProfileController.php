<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    public function show($id){
        $company = Company::with('projects')->findOrFail($id);
        $projects = $company->projects;
        $user = $company->user;
        
        $transactions = Transaction::where('payer_id', $user->id)
                    ->orWhere('payee_id', $user->id)
                    ->with('project')
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('companies.profile', compact('company','user','projects','transactions'));
    }

    public function edit($id){
        $user = User::findOrFail($id);

        return view('companies.edit-profile', compact('user'));
    }

    public function update(Request $request){
        
        $request->validate([
            'company_name'          => 'required|min:1|max:50',
            'email'         => 'required|email|max:50|unique:users,email,' . Auth::user()->id,
            'avatar'        => 'mimes:jpeg,jpg,png,gif|max:1048',
            'address'       => 'nullable|string|max:255',
            'website'       => 'nullable|string|max:255',
            'paypal_account'   => 'required|string|max:255',
            'representative'       => 'nullable|string|max:255',
            'employee'       => 'nullable|integer',
            'capital'       => 'nullable|numeric',
            'annualsales'       => 'nullable|string|max:255',
            'description'  => 'nullable|string|max:255'
        ]);


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

        return redirect()->route('company.profile', $company->id);
    }
}