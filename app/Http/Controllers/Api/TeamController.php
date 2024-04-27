<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeamStoreRequest;
use App\Models\TeamAdministrative;
use App\Providers\RouteServiceProvider;
use App\Repositories\Team\TeamInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
    private TeamInterface $team;
    public function __construct(TeamInterface $team)
    {
        $this->team = $team;
    }

    public function index()
    {

        $team = $this->team->getById(Auth::user()->team->id);
        return response()->json(['team'=>$team] , 200);
    }

    public function update(Request $request)
    {

        $request->validate([
            'avatar' => 'nullable|image',
            'team_name' => 'required|string',
            'administrative_name' => 'required|string',
            'password' => 'nullable|min:6',
            'email' => 'required|email|unique:team_administrators,email',
            'players' => 'required|array',
            'players.*' => 'required|string',
        ]);

        $this->team->update($request,Auth::user()->team->id);

        return response()->json(['message'=>'Team updated Successfully'] , 200);
    }


}
