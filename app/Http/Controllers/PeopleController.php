<?php

namespace App\Http\Controllers;

use App\Http\Requests\People\PeopleRequest;
use App\Http\Requests\People\UpdatePeopleRequest;
use App\Services\PeopleService;

class PeopleController extends Controller
{
    private $peopleService;

    public function __construct(PeopleService $peopleService)
    {
        $this->peopleService = $peopleService;
        $this->middleware('auth:sanctum')->only('store', 'update', 'destroy');
    }

    public function index()
    {
        //
    }

    public function store(PeopleRequest $request)
    {
        return $this->peopleService->createPeople($request);
    }

    public function show($id)
    {
        return $this->peopleService->getPeoplebyId($id);
    }

    public function update(UpdatePeopleRequest $request, $id)
    {
        return $this->peopleService->updatePeople($id, $request);
    }

    public function destroy($id)
    {
        $this->peopleService->deletePeople($id);
    }
}
