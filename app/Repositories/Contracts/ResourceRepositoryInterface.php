<?php

namespace App\Repositories\Contracts;

use \App\Models\Resource;

Interface ResourceRepositoryInterface
{
    public function getResourceById(int $id);
    public function getAllResource();
}
