<?php

namespace App\Repositories\Contracts;

use App\Models\People;

interface PeopleRepositoryInterface
{
    public function getPeoplebyId(int $id);
    public function createPeople(array $request);
    public function updatePeople(People $people, array $request);
    public function deletePeople(People $people);
}
