<?php

namespace App\Services;

use App\Repositories\Contracts\StatusRepositoryInterface;

class StatusService
{
    protected $statusRepository;

    public function __construct(StatusRepositoryInterface $statusRepository)
    {
        $this->statusRepository = $statusRepository;
    }

    public function getAllStatus()
    {
        return $this->statusRepository->getAllStatus();
    }

    public function createStatus(array $request)
    {
        return $this->statusRepository->createStatus($request);
    }

    public function getStatusById(int $id)
    {
        return $this->statusRepository->getStatusById($id);
    }

    public function updateStatus(int $id, array $request)
    {
        return $this->statusRepository->updateStatus($id, $request);
    }

    public function deleteStatus(int $id)
    {
        $user = auth()->user();
        if ($user->delete_status || $user->owner) {
            $this->statusRepository->deleteStatus($id);
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }
}
