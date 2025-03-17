<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo()
    {
        $user = auth()->user(); // ログインユーザー情報を取得

        if ($user->role_id == 1) {
            return route('admin.freelancer'); // Admin用ダッシュボード
        }
        
        
        if ($user->role_id == 2) {
            return route('company.project.on_going'); // 企業用ダッシュボード
        }

        if ($user->role_id == 3) {
            return route('freelancer.index'); // フリーランス用ページ
        }

        return '/home'; // それ以外はデフォルトのページへ
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
