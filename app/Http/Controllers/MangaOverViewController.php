<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MangaOverView;
use App\Http\Requests\Manga\CreateMangaOverViewRequest;

class MangaOverViewController extends Controller
{

    private $manga;

    public function __construct(MangaOverView $manga)
    {
        $this->manga = $manga;
        $this->middleware('auth:sanctum')->only('store', 'update', 'destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMangaOverViewRequest $request)
    {
        $infos = $request->all();
        if($photo = $request->file('photo')) $infos['photo'] = $photo->store('manga_photo', 'public');
        if($photo = $request->file('background_photo')) $infos['background_photo'] = $photo->store('manga_background_photo', 'public');
        unset($infos["status"]);
        unset($infos["format"]);
        $manga = $this->manga->create($infos);
        $manga->categories()->attach(array_map('intval', $request->categories));
        $manga->people()->attach(array_map('intval', $request->staffs));
        $manga->statuses()->save(\App\Models\Status::find((int)$request->status));
        $manga->formats()->save(\App\Models\Format::find((int)$request->format));
        return $this->manga->find($manga->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
