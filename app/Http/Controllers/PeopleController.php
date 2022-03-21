<?php

namespace App\Http\Controllers;

use App\Http\Requests\People\PeopleRequest;
use App\Http\Requests\People\UpdatePeopleRequest;
use Illuminate\Http\Request;
use App\Models\People;
use Illuminate\Support\Facades\Storage;

class PeopleController extends Controller
{
    private $people;

    public function __construct(People $people)
    {
        $this->people = $people;
        $this->middleware('auth:sanctum')->only('store', 'update', 'destroy');
    }

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }

    public function store(PeopleRequest $request)
    {
        $infos = $request->all();
        if($photo = $request->file('photo')) $infos['photo'] = $photo->store('people_photo', 'public');
        $people = $this->people->create($infos);
        return $this->people->find($people->id);
    }

    public function show($id)
    {
        $people = $this->people->find($id);
        if(!$people){
            return abort(404);
        }
        return $people;
    }

    public function edit($id)
    {
        //
    }

    public function update(UpdatePeopleRequest $request, $id)
    {
        $people = $this->people->find($id);
        $infos = $request->all();
        if ($photo = $request->file('photo')) {
            if (Storage::disk('public')->exists($people->photo)) {
                Storage::disk('public')->delete($people->photo);
            }
            $infos['photo'] = $photo->store('people_photo', 'public');
        }
        $people->update($infos);
        return $this->people->find($id);
    }

    public function destroy($id)
    {
        $user = auth()->user();
        if ($user->delete_people || $user->owner) {
            $people = $this->people->find($id);
            if(!$people) return abort(404);
            if (Storage::disk('public')->exists($people->photo)) {
                Storage::disk('public')->delete($people->photo);
            }
            $people->delete();
        } else {
            return abort(403,'Unauthorized action.');
        }
    }
}
