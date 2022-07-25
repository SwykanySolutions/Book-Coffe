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

    public function createPeople(Request $request)
    {
        $infos = $request->all();
        if($photo = $request->file('photo')) $infos['photo'] = $photo->store('people_photo', 'public');
        $people = $this->peopleRepository->createPeople($infos);
        return $this->peopleRepository->getPeoplebyId($people->id);
    }

    public function getPeoplebyId(int $id)
    {
        $people = $this->peopleRepository->getPeoplebyId($id);
        if(!$people){
            return abort(404);
        }
        return $people;
    }

    public function updatePeople(int $id, Request $request)
    {
        $people = $this->peopleRepository->getPeoplebyId($id);
        if(!$people){
            return abort(404);
        }
        $infos = $request->all();
        if ($photo = $request->file('photo')) {
            if (Storage::disk('public')->exists($people->photo)) {
                Storage::disk('public')->delete($people->photo);
            }
            $infos['photo'] = $photo->store('people_photo', 'public');
        }
        $this->peopleRepository->updatePeople($people, $infos);
        return $this->peopleRepository->getPeoplebyId($id);
    }

    public function deletePeople(int $id)
    {
        $user = auth()->user();
        if ($user->delete_people || $user->owner) {
            $people = $this->peopleRepository->getPeoplebyId($id);
            if(!$people) return abort(404);
            if (Storage::disk('public')->exists($people->photo)) {
                Storage::disk('public')->delete($people->photo);
            }
            $this->peopleRepository->deletePeople($people);
        } else {
            return abort(403,'Unauthorized action.');
        }
    }

}