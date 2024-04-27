<?php

namespace App\Http\Controllers\Api\Auth;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Http\Controllers\Controller;
use App\Http\Methods\ReCaptchaValidation;
use App\Http\Requests\TeamStoreRequest;
use App\Models\TeamAdministrative;
use App\Providers\RouteServiceProvider;
use App\Repositories\Team\TeamInterface;
use Facebook\Facebook;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    private TeamInterface $team;
    public function __construct(TeamInterface $team)
    {
        $this->team = $team;
    }


    public function register(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image',
            'team_name' => 'required|string',
            'administrative_name' => 'required|string',
            'password' => 'required|min:6',
            'email' => 'required|email|unique:team_administrators,email',
            'players' => 'required|array',
            'players.*' => 'required|string',
        ]);

        try {

            $team = $this->team->store($request);

            $teamAdministrative = TeamAdministrative::find($team->team_administrative_id);

            $token = $teamAdministrative->createToken($team->name)->accessToken;

            return response()->json(['token' => $token,'user'=>$team->teamAdministrative] , 200);

        }catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()] , 200);
        }
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = TeamAdministrative::where(['email' => $request['email']])->first();

        if (isset($user) && Hash::check($request['password'], $user['password'])) {

            $token = $user->createToken('Token Name')->accessToken;


            return response()->json(['token' => $token,'user'=>$user] , 200);

        }

        return response()->json(['error' => 'wrong credential'] , 401);
    }

}
