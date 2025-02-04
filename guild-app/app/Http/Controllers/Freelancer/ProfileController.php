<?php

namespace App\Http\Controllers\Freelancer;
use App\Http\Controllers\Controller;
use App\Models\Freelancer;
use App\Models\User;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($id){
        $user = User::findOrFail($id);

        return view('users.profile', compact('user'));
    }


    public function edit($id){
        $user = User::findOrFail($id);

        return view('users.edit-profile', compact('user'));
    }
}
