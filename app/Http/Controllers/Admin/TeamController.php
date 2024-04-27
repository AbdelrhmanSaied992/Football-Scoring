<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeamStoreRequest;
use App\Providers\RouteServiceProvider;
use App\Repositories\Team\TeamInterface;
use Illuminate\Http\Request;
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
        $teams = $this->team->getAll();
        return view('admin.team.index',compact('teams'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'avatar' => 'required|image',
            'team_name' => 'required|string',
            'administrative_name' => 'required|string',
            'password' => 'required|min:6',
            'email' => 'required|email|unique:team_administrators,email',
            'players' => 'required|array',
            'players.*' => 'required|string',
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back()->withInput();
        }

        try {


            $this->team->store($request);

            toastr()->success(__('Created Successfully'));

            return redirect()->route('admin.teams.index');

        }catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return back();
        }

    }



    public function edit($id)
    {
        $team = $this->team->getById($id);
        return view('admin.team.update',compact('team'));
    }

    public function update(Request $request,$id)
    {

        $validator = Validator::make($request->all(), [
            'avatar' => 'nullable|image',
            'team_name' => 'required|string',
            'administrative_name' => 'required|string',
            'password' => 'nullable|min:6',
            'email' => 'required|email|unique:team_administrators,email',
            'players' => 'required|array',
            'players.*' => 'required|string',
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return back()->withInput();
        }

        $this->team->update($request,$id);
        toastr()->success(__('Team updated Successfully'));
        return redirect()->route('admin.teams.index');
    }

    public function destroy($id)
    {
        $this->team->delete($id);

        toastr()->success(__('Team Deleted Successfully'));

        return redirect()->route('admin.teams.index');
    }


}
