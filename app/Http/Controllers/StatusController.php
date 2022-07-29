<?php

namespace App\Http\Controllers;

use App\Http\Requests\Status\CreateStatusRequest;
use App\Http\Requests\Status\UpdateStatusRequest;
use App\Services\StatusService;

class StatusController extends Controller
{
    private $statusService;

    public function __construct(StatusService $statusService)
    {
        $this->statusService = $statusService;
        $this->middleware('auth:sanctum')->only('store', 'update', 'destroy');
    }

    public function store(CreateStatusRequest $request)
    {
        return $this->statusService->createStatus($request->all());
    }

    public function show($id)
    {
        return $this->statusService->getStatusById($id);
    }

    public function update(UpdateStatusRequest $request, $id)
    {
        return $this->statusService->updateStatus($id, $request->all());
    }

    public function destroy($id)
    {
        $this->statusService->deleteStatus($id);
    }
}
