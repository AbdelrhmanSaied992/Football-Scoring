<?php

namespace App\Http\Controllers\Api;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Http\Controllers\Controller;
use App\Http\Methods\ReCaptchaValidation;
use App\Http\Requests\TeamStoreRequest;
use App\Models\Tournament;
use App\Providers\RouteServiceProvider;
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

class TournamentController extends Controller
{
    private TournamentInterface $tournament;
    public function __construct(TournamentInterface $tournament)
    {
        $this->tournament = $tournament;

    }

    public function index()
    {
        $joinedTournaments = Auth::user()->team->joinedTournaments;

        $tournaments = [];
        foreach ($joinedTournaments as $joinedTournament)
            {
                $tournaments[] = $joinedTournament->tournament;
            }


        return response()->json(['tournaments'=>$tournaments] , 200);
    }

    public function leaderboard($id)
    {

        Tournament::findOrFail($id);

        $leaderboard = $this->tournament->getLeaderboard($id);





        return response()->json(['leaderboard'=>$leaderboard] , 200);
    }


}
