<?php

namespace App\Http\Controllers;

use App\Http\Requests\People\PeopleRequest;
use App\Http\Requests\People\UpdatePeopleRequest;
use App\Services\PeopleService;

class PeopleController extends Controller
{
    private $people;

    public function __construct(PeopleService $people)
    {
        $this->people = $people;
        $this->middleware('auth:sanctum')->only('store', 'update', 'destroy');
    }

    public function index()
    {
        //
    }

    public function store(PeopleRequest $request)
    {
        return $this->people->createPeople($request);
    }

    public function show($id)
    {
        return $this->people->getPeoplebyId($id);
    }

    public function update(UpdatePeopleRequest $request, $id)
    {
        return $this->people->updatePeople($id, $request);
    }

    public function destroy($id)
    {
        $this->people->deletePeople($id);
    }
}
