<?php

namespace App\Http\Controllers\Admin;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Http\Controllers\Controller;
use App\Http\Methods\ReCaptchaValidation;
use App\Http\Requests\TeamStoreRequest;
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
    private TeamInterface $team;
    public function __construct(TournamentInterface $tournament,TeamInterface $team)
    {
        $this->tournament = $tournament;
        $this->team = $team;
    }

    public function index()
    {
        $tournaments = $this->tournament->getAll();
        return view('admin.tournament.index',compact('tournaments'));
    }

    public function create()
    {
        $teams = $this->team->getAll();
        return view('admin.tournament.create',compact('teams'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'avatar' => 'required|image',
            'name' => 'required|string',
            'format' => 'required|in:knockout,round-robin',
            'teams' => 'required|array',
            'teams.*' => 'required|exists:teams,id',
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back()->withInput();
        }


        if (count($request->teams) <= 1)
        {
            toastr()->error('You must specify at least two teams');
            return back()->withInput();
        }

        try {
            $this->tournament->store($request);

            toastr()->success(__('Created Successfully'));

            return redirect()->route('admin.tournaments.index');

        }catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return back()->withInput();
        }



    }

    public function edit($id)
    {
        $tournament = $this->tournament->getById($id);
        $teams = $this->team->getAll();
        $selectedTeamsID = $tournament->joinedTeams->pluck('team_id');
        return view('admin.tournament.update',compact('tournament','teams','selectedTeamsID'));
    }

    public function update(Request $request,$id)
    {

        $validator = Validator::make($request->all(), [
            'avatar' => 'nullable|image',
            'name' => 'required|string',
            'teams' => 'required|array',
            'teams.*' => 'required|exists:teams,id',
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back()->withInput();
        }

        $this->tournament->update($request,$id);
        toastr()->success(__('Tournament updated Successfully'));
        return redirect()->route('admin.tournaments.index');
    }

    public function destroy($id)
    {
        $this->tournament->delete($id);
        toastr()->success(__('Tournament deleted Successfully'));
        return redirect()->route('admin.tournaments.index');
    }


}
