<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth; 

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('login.login');
    }

    protected function authenticated(Request $request, $user)
    {
        if($user->role_id != 1){
            $this->guard()->logout();
            $request->session()->invalidate();
            return redirect('/login')->withErrors(["You don't have right permission to login"]);;
        }

        return redirect()->intended($this->redirectPath());
    }

    // public function login()
    // {
    //     return view('login.login');
    // }

    // public function checkLogin() {
    //     if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
    //         $user = Auth::user(); 
            
    //         print_r($user);
    //         die();
    //     } 
    // }
}
