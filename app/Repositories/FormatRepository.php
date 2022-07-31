<?php

namespace App\Repositories;

use App\Models\Format;
use App\Repositories\Contracts\FormatRepositoryInterface;

class FormatRepository implements FormatRepositoryInterface
{

    protected $format;

    public function __construct(Format $format)
    {
        $this->format = $format;
    }

    public function getAllFormat()
    {
        return $this->format->all();
    }

    public function getFormatbyId(int $id)
    {
        return $this->format->find($id);
    }

    public function createFormat(array $request)
    {
        return $this->format->create($request);
    }

    public function updateFormat(array $request, int $id)
    {
        $format = $this->format->find($id);
        $format->update($request);
        return $this->format->find($id);
    }

    public function deleteFormat(Format $format)
    {
        $format->delete();
    }

}
