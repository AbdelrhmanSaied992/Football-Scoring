<?php

namespace App\Repositories\Tournament;


use App\Models\ParticipatingTeam;
use App\Models\Player;
use App\Models\Team;
use App\Models\TeamAdministrative;
use App\Models\Tournament;
use App\Repositories\Team\TeamInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TournamentRepository implements TournamentInterface {

    public function getAll()
    {
        return Tournament::all();
    }

    public function getAllWhere($field,$data)
    {
        return Tournament::with('joinedTeams')->where($field,$data)->get();
    }

    public function getById($id)
    {
        return Tournament::with('joinedTeams')->find($id);
    }

    public function getLeaderboard($id)
    {
        $tournament = Tournament::with('joinedTeams')->find($id);


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


        return $result;

    }

    public function delete($id)
    {
        Tournament::find($id)->delete();
    }

    public function store($request)
    {

        try {
            DB::BeginTransaction();

            $avatar = vImageUpload($request->file('avatar'), 'images/', '1000x1000');

            $tournamentData =
                [
                    'name' => $request->name,
                    'logo' => $avatar,
                    'format' => $request->format,
                ];

            $tournament = Tournament::create($tournamentData);

            foreach ($request->teams as $team)
            {
                ParticipatingTeam::create(['team_id' =>$team,'tournament_id' =>$tournament->id, 'result' =>0]);

            }

            DB::commit();

            return $tournament;

        }catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    public function update($request, $id)
    {
        try {
            DB::BeginTransaction();

            $tournament = $this->getById($id);


            $tournamentData =
                [
                    'name' => $request->name,
                ];

            if (!is_null($request->avatar))
            {
                $avatar = vImageUpload($request->file('avatar'), 'images/', '1000x1000');

                $tournamentData['logo'] = $avatar;

            }



            $tournament->update($tournamentData);

            ParticipatingTeam::where('tournament_id',$id)->delete();

            foreach ($request->teams as $team)
            {
                ParticipatingTeam::create(['team_id' =>$team,'tournament_id' =>$tournament->id, 'result' =>0]);
            }

            DB::commit();

            return $team;

        }catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }
}
