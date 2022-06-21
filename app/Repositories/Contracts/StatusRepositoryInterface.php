<?php

namespace App\Repositories\Contracts;

interface StatusRepositoryInterface
{
    public function createStatus(array $request);
    public function updateStatus(int $id, array $request);
    public function deleteStatus(int $id);
}
