<?php

namespace App\Repositories\Tournament;


use Illuminate\Http\Request;

interface TournamentInterface {

    public function getAll();

    public function getById($id);
    public function getLeaderboard($id);
    public function getAllWhere($field,$data);

    public function store($request);

    public function delete($id);
}
