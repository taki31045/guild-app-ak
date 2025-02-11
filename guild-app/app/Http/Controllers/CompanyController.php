<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;


class CompanyController extends Controller
{


    public function index(){
        $user = User::findOrFail(Auth::user()->id);
        $projects = $user->company->projects;
        return view('companies.dashboard', compact('projects'));
    }
}
