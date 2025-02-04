<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected function redirectTo()
    {
        if (auth()->user()->role_id == 2) {
            return '/company'; // 企業のダッシュボード
        } elseif (auth()->user()->role_id == 3) {
            return '/user-dashboard'; // フリーランサーのダッシュボード
        }
    }

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Validate the user registration data.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // Validation rules for both role_id 2 (company) and 3 (freelancer)
        $rules = [
            'role_id' => ['required', 'in:2,3'], // Role must be either company (2) or freelancer (3)
        ];

        // Additional validation based on role_id
        if ($data['role_id'] == '2') { // For companies
            $rules = array_merge($rules, [
                'company_name' => ['required', 'string', 'max:255'],
                'company_email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                'company_password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        } elseif ($data['role_id'] == '3') { // For freelancers
            $rules = array_merge($rules, [
                'username' => ['required', 'string', 'max:255'],
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }

        return Validator::make($data, $rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function create(array $data)
    {
        // Handle company registration
        if ($data['role_id'] == '2') { // For companies
            return User::create([
                'username' => $data['company_name'],
                'name' => $data['company_name'],
                'email' => $data['company_email'], // Use company email
                'password' => Hash::make($data['company_password']),
                'role_id' => $data['role_id'], 
                
            ]);
        } 

        // Handle freelancer registration
        elseif ($data['role_id'] == '3') { // For freelancers
            return User::create([
                'username' => $data['username'],
                'name' => $data['name'],
                'email' => $data['email'], // Use freelancer email
                'password' => Hash::make($data['password']),
                'role_id' => $data['role_id'], 
            ]);
        }
    }
}

