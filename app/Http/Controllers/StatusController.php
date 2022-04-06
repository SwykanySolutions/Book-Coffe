<?php

namespace App\Http\Controllers;

use App\Http\Requests\Status\CreateStatusRequest;
use App\Http\Requests\Status\UpdateStatusRequest;
use Illuminate\Http\Request;
use App\Models\Status;

class StatusController extends Controller
{
    private $status;

    public function __construct(Status $status)
    {
        $this->status = $status;
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
    public function store(CreateStatusRequest $request)
    {
        return $this->status->create($request->all());
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
    public function update(UpdateStatusRequest $request, $id)
    {
        $status = $this->status->find($id);
        $status->update($request->all());
        return $this->status->find($id);
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
        if($user->delete_status || $user->owner){
            $status = $this->status->find($id);
            if(!$status) return abort(404);
            $status->delete();
        } else {
            return abort(403,'Unauthorized action.');
        }
    }
}
