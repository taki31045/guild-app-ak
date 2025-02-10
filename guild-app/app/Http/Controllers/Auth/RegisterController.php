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

    protected $redirectTo = '/';


    public function __construct(){
        $this->middleware('guest');
    }


    public function registered($request, $user){

        if ($user->role_id == 2) {
            return redirect()->route('company.dashboard');
        }

        if ($user->role_id == 3) {
            return redirect()->route('freelance');
        }

        return redirect('/home');
    }

    /**
     * Note: This function expects to recieved string
     */
    // protected function redirectTo()
    // {
    //     // 役割に基づいてリダイレクト先を設定
    //     if (auth()->user()->role_id == 2) {
    //         return '/company'; // 会社のダッシュボードにリダイレクト
    //     }
    //     if (auth()->user()->role_id == 3) {
    //         return redirect()->route('/freelance'); // フリーランスのダッシュボードにリダイレクト
    //     }
    // }
    protected function validator(array $data)
    {
        $rules = [
            'role_id' => ['required', 'in:2,3'], // Role must be either company (2) or freelancer (3)
        ];
        // Add validation rules based on role_id
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
    protected function create(array $data)
    {
        // Create the user based on the role_id
        if ($data['role_id'] == '2') {
            // Company registration
            return User::create([
                'username' => $data['company_name'],
                'name' => $data['company_name'], // Consider renaming 'name' to 'company_name' in the User model
                'email' => $data['company_email'],
                'password' => Hash::make($data['company_password']),
                'role_id' => $data['role_id'],
            ]);
        }
        if ($data['role_id'] == '3') {
            // Freelancer registration
            return User::create([
                'username' => $data['username'],
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role_id' => $data['role_id'],
            ]);
        }
    }
}

