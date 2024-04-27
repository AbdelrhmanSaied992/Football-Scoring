<?php

namespace App\Http\Controllers\Admin\Auth;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Http\Controllers\Controller;
use App\Http\Methods\ReCaptchaValidation;
use App\Providers\RouteServiceProvider;
use Facebook\Facebook;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Admin Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating admins for the application and
    | redirecting them to your dashboard screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    public $redirectTo = RouteServiceProvider::ADMIN;


    public function __construct()
    {
        $this->middleware('admin.guest')->except('logout');
    }


    public function redirectToLogin()
    {
        return redirect()->route('admin.login');
    }

    public function index()
    {
        dd(0);
        return view('admin.dashboard');
    }


    public function showLoginForm()
    {
        return view('admin.login');
    }


    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }


    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
        ? new JsonResponse([], 204)
        : redirect('/');
    }



    protected function guard()
    {
        return Auth::guard('admin');
    }



}
