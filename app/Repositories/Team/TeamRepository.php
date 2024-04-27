<?php

namespace App\Repositories\Team;


use App\Http\Helpers\Helper;
use App\Models\Player;
use App\Models\Team;
use App\Models\TeamAdministrative;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use function PHPUnit\Framework\throwException;

class TeamRepository implements TeamInterface {

    public function getAll()
    {
        return Team::all();
    }

    public function getById($id)
    {
        return Team::with('players','teamAdministrative')->find($id);
    }

    public function delete($id)
    {
        $team = $this->getById($id);
        Team::find($id)->delete();
        TeamAdministrative::find($team->teamAdministrative->id)->delete();
    }

    public function store($request)
    {

        try {
            DB::BeginTransaction();


            $AdminTeam = new TeamAdministrative();
            $AdminTeam->name = $request->administrative_name;
            $AdminTeam->email = $request->email;
            $AdminTeam->password = Hash::make($request->password);
            $AdminTeam->save();


            $avatar = vImageUpload($request->file('avatar'), 'images/', '1000x1000');


            $teamData =
                [
                    'name' => $request->team_name,
                    'image' => $avatar,
                    'team_administrative_id' => $AdminTeam->id,
                ];

            $team = Team::create($teamData);

            foreach ($request->players as $player)
            {
                Player::create(['name' =>$player,'team_id' =>$team->id]);
            }

            DB::commit();

            return $team;

        }catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    public function update($request, $id)
    {
        try {
            DB::BeginTransaction();

            $team = $this->getById($id);


            $AdminTeam = TeamAdministrative::find($team->team_administrative_id);
            $AdminTeam->name = $request->administrative_name;
            $AdminTeam->email = $request->email;

            if (is_null($request->password))
            {
                $AdminTeam->password = Hash::make($request->password);
            }


            $AdminTeam->save();

            $teamData =
                [
                    'name' => $request->team_name,
                    'team_administrative_id' => $AdminTeam->id,
                ];

            if (!is_null($request->avatar))
            {
                $avatar = vImageUpload($request->file('avatar'), 'images/', '1000x1000');

                $teamData['image'] = $avatar;

            }





            $team->update($teamData);

            Player::where('team_id',$id)->delete();

            foreach ($request->players as $player)
            {
                Player::create(['name' =>$player,'team_id' =>$team->id]);
            }

            DB::commit();

            return $team;

        }catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }
}
