<?php

namespace App\Http\Controllers\Admin;

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
        $matches = $this->match->getAll();
        return view('admin.match.index',compact('matches'));
    }

    public function create()
    {
        $tournaments = $this->tournament->getAll();
        $teams = $this->team->getAll();
        return view('admin.match.create',compact('tournaments','teams'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'tournament_id' => 'required|exists:tournaments,id',
            'first_team' => 'required|exists:teams,id',
            'second_team' => 'required|exists:teams,id',
            'date' => 'required|date|after:today',
            'venue' => 'required|string',
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back()->withInput();
        }

        if ($request->first_team == $request->second_team)
        {
            toastr()->error('teams must be different');
            return back()->withInput();
        }

        try {
            $this->match->store($request);

            toastr()->success(__('Created Successfully'));

            return redirect()->route('admin.matches.index');

        }catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return back()->withInput();
        }

    }

    public function edit($id)
    {
        $match = $this->match->getById($id);
        $tournaments = $this->tournament->getAll();
        $teams = $this->team->getAll();
        return view('admin.match.update',compact('match','tournaments','teams','teams'));
    }

    public function update(Request $request,$id)
    {

        $validator = Validator::make($request->all(), [
            'score_first_team' => 'required|numeric',
            'score_second_team' => 'required|numeric',
            'venue' => 'required|string',
            'status' => 'required|in:0,1,2',
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back()->withInput();
        }

        $this->match->update($request,$id);
        toastr()->success(__('Match updated Successfully'));
        return redirect()->route('admin.matches.index');
    }

    public function destroy($id)
    {
        $this->match->delete($id);
        toastr()->success(__('Match deleted Successfully'));
        return redirect()->route('admin.matches.index');
    }

}
