<?php

namespace App\Services;

use App\Repositories\Contracts\PeopleRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PeopleService
{

    protected $peopleRepository;

    public function __construct(PeopleRepositoryInterface $peopleRepository)
    {
        $this->peopleRepository = $peopleRepository;
    }

    public function getAllPeople()
    {
        return $this->peopleRepository->getAllPeople();
    }

    public function createPeople(Request $request)
    {
        $infos = $request->all();
        if ($photo = $request->file('photo')) {
            $infos['photo'] = $photo->store('people_photo');
        }

        $people = $this->peopleRepository->createPeople($infos);
        return $this->peopleRepository->getPeoplebyId($people->id);
    }

    public function getPeoplebyId(int $id)
    {
        $people = $this->peopleRepository->getPeoplebyId($id);
        if (!$people) {
            return abort(404);
        }
        return $people;
    }

    public function updatePeople(int $id, Request $request)
    {
        $people = $this->peopleRepository->getPeoplebyId($id);
        if (!$people) {
            return abort(404);
        }
        $infos = $request->all();
        if ($photo = $request->file('photo')) {
            $photoPath = $people->photo;
            if (str_contains($photoPath, 'imgs/') == false) {
                if (Storage::disk()->exists($photoPath)) {
                    Storage::disk()->delete($photoPath);
                }
            }
            $infos['photo'] = $photo->store('people_photo');
        }
        $this->peopleRepository->updatePeople($people, $infos);
        return $this->peopleRepository->getPeoplebyId($id);
    }

    public function deletePeople(int $id)
    {
        $people = $this->peopleRepository->getPeoplebyId($id);
        if (!$people) {
            return abort(404);
        }

        $photoPath = $people->photo;
        if (str_contains($photoPath, 'imgs/') == false) {
            if (Storage::disk()->exists($photoPath)) {
                Storage::disk()->delete($photoPath);
            }
        }
        $this->peopleRepository->deletePeople($people);
    }

}