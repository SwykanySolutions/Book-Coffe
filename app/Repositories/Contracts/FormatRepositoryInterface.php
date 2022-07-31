<?php

namespace App\Repositories\Contracts;

use App\Models\Format;

interface FormatRepositoryInterface
{
    public function getAllFormat();
    public function getFormatbyId(int $id);
    public function createFormat(array $request);
    public function updateFormat(array $request, int $id);
    public function deleteFormat(Format $format);
}
