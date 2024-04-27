<?php

namespace App\Repositories\Team;


use Illuminate\Http\Request;

interface TeamInterface {

    public function getAll();

    public function getById($id);

    public function store($request);

    public function update($request,$id);

    public function delete($id);
}
