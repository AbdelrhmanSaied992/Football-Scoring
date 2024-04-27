<?php

namespace App\Repositories\Match;


use App\Models\MatchResult;
use App\Models\MatchScheduling;
use App\Models\ParticipatingTeam;
use App\Models\Player;
use App\Models\Team;
use App\Models\TeamAdministrative;
use App\Models\Tournament;
use App\Repositories\Team\TeamInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MatchRepository implements MatchInterface {

    public function getAll()
    {
        return MatchScheduling::with('matchResults','tournament')->get();
    }

    public function getById($id)
    {
        return MatchScheduling::with('matchResults','tournament')->find($id);
    }

    public function delete($id)
    {
        MatchScheduling::find($id)->delete();
    }

    public function store($request)
    {

        try {
            DB::BeginTransaction();

            $dateCarbon = Carbon::parse($request->date);

            $matchData =
                [
                    'venue' => $request->venue,
                    'tournament_id' => $request->tournament_id,
                    'date' => $dateCarbon->toDateString(),
                    'time' => $dateCarbon->toTimeString(),
                    'status' => '0',
                ];

            $match = MatchScheduling::create($matchData);

            $matchResult = new MatchResult();

            $matchResult->team_id = $request->first_team;
            $matchResult->match_scheduling_id = $match->id;
            $matchResult->score = '0';
            $matchResult->save();

            $matchResult = new MatchResult();
            $matchResult->team_id = $request->second_team;
            $matchResult->match_scheduling_id = $match->id;
            $matchResult->score = '0';
            $matchResult->save();


            DB::commit();

            return $match;

        }catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    public function update($request, $id)
    {
        try {
            DB::BeginTransaction();

            $match = $this->getById($id);


            $matchData =
                [
                    'venue' => $request->venue,
                    'status' => $request->status,
                ];



            $match->update($matchData);


            $firstTeam = MatchResult::find($match->matchResults[0]->id);
            $firstTeam->score = $request->score_first_team;
            $firstTeam->save();

            $secondTeam = MatchResult::find($match->matchResults[1]->id);
            $secondTeam->score = $request->score_second_team;
            $secondTeam->save();




            DB::commit();

            return $match;

        }catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }
}
