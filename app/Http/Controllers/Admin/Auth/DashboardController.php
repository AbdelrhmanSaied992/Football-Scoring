<?php

namespace App\Http\Controllers\Admin\Auth;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Http\Controllers\Controller;
use App\Http\Methods\ReCaptchaValidation;
use App\Providers\RouteServiceProvider;
use App\Repositories\Match\MatchInterface;
use App\Repositories\Team\TeamInterface;
use App\Repositories\Tournament\TournamentInterface;
use Facebook\Facebook;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Laravel\Socialite\Facades\Socialite;

class DashboardController extends Controller
{
    private TournamentInterface $tournament;
    private TeamInterface $team;
    private MatchInterface $match;
    public function __construct(TournamentInterface $tournament,TeamInterface $team,MatchInterface $match)
    {
        $this->tournament = $tournament;
        $this->team = $team;
        $this->match = $match;
    }

    public function index()
    {
        $tournaments = $this->tournament->getAll();
        $teams = $this->team->getAll();
        $matches = $this->match->getAll();

        $AllTournaments = [];
        foreach ($tournaments as $tournament)
        {
            $result = [];

            foreach ($tournament->joinedTeams as $team)
            {
                $points = 0;
                $matchCounter = 0;
                foreach ($team->team->matchResults as $resultMatch)
                {
                    $matchCounter +=1;
                    $match = $resultMatch->matchScheduling;
                    if ($match->status == '2')
                    {
                        $meScore = $resultMatch->score;
                        $homeScore = $match->matchResults[0]->score;
                        $awayScore = $match->matchResults[1]->score;

                        if ($meScore != $homeScore)
                        {
                            $awayScore = $homeScore;
                        }

                        if ($meScore == $awayScore)
                        {
                            $points += 1;
                        }elseif ($meScore > $awayScore)
                        {
                            $points += 3;
                        }

                    }

                }
                $obj =
                    [
                        'team' => $team->team,
                        'points' => $points,
                        'matches' => $matchCounter,
                    ];

                $result [] = $obj;
            }
            $collection = Collection::make($result);

            $sorted = $collection->sortByDesc('points')->values()->all();
            $result = $sorted;


            $AllTournaments [] =
            [
                'tournament' => $tournament,
                'result' => $result,
            ];
        }



        return view('admin.dashboard',compact('tournaments', 'teams', 'matches','AllTournaments'));
    }


}
