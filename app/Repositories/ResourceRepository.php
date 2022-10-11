<?php

namespace App\Repositories;

use \App\Repositories\Contracts\ResourceRepositoryInterface;
use \App\Models\Resource;

class ResourceRepository implements ResourceRepositoryInterface
{

    protected $resource;

    public function __construct(Resource $resource)
    {
        $this->resource = $resource;
    }

    public function getResourceById(int $id)
    {
        return $this->resource->find($id);
    }

    public function getAllResource()
    {
        return $this->resource->all();
    }
}
