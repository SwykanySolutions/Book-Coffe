<?php

namespace App\Services;

use App\Repositories\Contracts\FormatRepositoryInterface;

class FormatService
{

    protected $formatRepository;

    public function __construct(FormatRepositoryInterface $formatRepository)
    {
        $this->formatRepository = $formatRepository;
    }

    public function getAllFormat()
    {
        return $this->formatRepository->getAllFormat();
    }

    public function getFormatById(int $id)
    {
        return $this->formatRepository->getFormatById($id);
    }

    public function createFormat(array $request)
    {
        return $this->formatRepository->createFormat($request);
    }

    public function updateFormat(array $request, int $id)
    {
        return $this->formatRepository->updateFormat($request, $id);
    }

    public function deleteFormat(int $id)
    {
        $user = auth()->user();
        if ($user->delete_format || $user->owner) {
            $format = $this->formatRepository->getFormatbyId($id);
            if (!$format) {
                return abort(404);
            }

            $this->formatRepository->deleteFormat($format);
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }

}
