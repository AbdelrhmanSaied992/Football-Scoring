<?php

namespace App\Repositories\Match;


use Illuminate\Http\Request;

interface MatchInterface {

    public function getAll();

    public function getById($id);

    public function store($request);

    public function delete($id);
}
