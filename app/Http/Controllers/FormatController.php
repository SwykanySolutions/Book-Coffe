<?php

namespace App\Http\Controllers;

use App\Http\Requests\Format\CreateFormatRequest;
use App\Http\Requests\Format\UpdateFormatRequest;
use Illuminate\Http\Request;
use App\Models\Format;

class FormatController extends Controller
{
    private $format;

    public function __construct(Format $format)
    {
        $this->format = $format;
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
    public function store(Request $request)
    {
        return $this->format->create($request->all());
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
        $format = $this->format->find($id);
        $format->update($request->all());
        return $this->format->find($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = auth()->user();
        if($user->delete_format || $user->owner){
            $format = $this->format->find($id);
            if(!$format) return abort(404);
            $format->delete();
        } else {
            return abort(403,'Unauthorized action.');
        }
    }
}
