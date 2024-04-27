<?php

namespace App\Http\Controllers\Api;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Http\Controllers\Controller;
use App\Http\Methods\ReCaptchaValidation;
use App\Http\Requests\TeamStoreRequest;
use App\Providers\RouteServiceProvider;
use App\Repositories\Match\MatchInterface;
use App\Repositories\Team\TeamInterface;
use App\Repositories\Tournament\TournamentInterface;
use Facebook\Facebook;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class MatchController extends Controller
{

    public function __construct(TournamentInterface $tournament,TeamInterface $team,MatchInterface $match)
    {
        $this->tournament = $tournament;
        $this->team = $team;
        $this->match = $match;
    }

    public function index()
    {
        $matchResults = Auth::user()->team->matchResults;

        $matches = [];
        foreach ($matchResults as $matchResult)
        {
            $match = $matchResult->matchScheduling;

            $obj =
                [
                    'match_details' => $match,
                    'teams' => $match->matchResults
                ];

            $matches [] = $obj;

        }


        return response()->json(['matches'=>$matches] , 200);
    }

    public function scores($id)
    {
        $match = $this->match->getById($id);



        return response()->json(['match_details'=>$match] , 200);
    }


}
