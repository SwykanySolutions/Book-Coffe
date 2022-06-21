<?php

namespace App\Http\Controllers;

use App\Http\Requests\Status\CreateStatusRequest;
use App\Http\Requests\Status\UpdateStatusRequest;
use App\Services\StatusService;

class StatusController extends Controller
{
    private $status;

    public function __construct(StatusService $status)
    {
        $this->status = $status;
        $this->middleware('auth:sanctum')->only('store', 'update', 'destroy');
    }

    public function store(CreateStatusRequest $request)
    {
        return $this->status->createStatus($request->all());
    }

    public function show($id)
    {
        //
    }

    public function update(UpdateStatusRequest $request, $id)
    {
        return $this->status->updateStatus($id, $request->all());
    }

    public function destroy($id)
    {
        $this->status->deleteStatus($id);
    }
}
