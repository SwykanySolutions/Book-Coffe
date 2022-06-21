<?php

namespace App\Repositories;

use App\Repositories\Contracts\PeopleRepositoryInterface;
use App\Models\People;

class PeopleRepository implements PeopleRepositoryInterface
{

    protected $people;

    public function __construct(People $people)
    {
        $this->people = $people;
    }

    public function getPeoplebyId(int $id)
    {
        return $this->people->find($id);
    }

    public function createPeople(array $request)
    {
        return $this->people->create($request);
    }

    public function updatePeople(People $people, array $request)
    {
        return $people->update($request);
    }

    public function deletePeople(People $people)
    {
       $people->delete();
    }

}
