<?php

namespace App\Repositories;

use App\Repositories\Contracts\StatusRepositoryInterface;
use App\Models\Status;

class StatusRepository implements StatusRepositoryInterface
{

    protected $status;

    public function __construct(Status $status)
    {
        return $this->status = $status;
    }

    public function createStatus(array $request)
    {
        return $this->status->create($request);
    }

    public function updateStatus(int $id, array $request)
    {
        $status = $this->status->find($id);
        $status->update($request);
        return $this->status->find($id);
    }

    public function deleteStatus(int $id)
    {
        $status = $this->status->find($id);
        if(!$status) return abort(404);
        $status->delete();
    }

}
