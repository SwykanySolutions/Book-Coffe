<?php

namespace App\Http\Controllers;

use App\Http\Requests\Format\CreateFormatRequest;
use App\Http\Requests\Format\UpdateFormatRequest;
use App\Services\FormatService;

class FormatController extends Controller
{
    private $formatService;

    public function __construct(FormatService $formatService)
    {
        $this->formatService = $formatService;
        $this->middleware('auth:sanctum')->only('store', 'update', 'destroy');
    }

    public function store(CreateFormatRequest $request)
    {
        return $this->formatService->createFormat($request->all());
    }

    public function update(UpdateFormatRequest $request, $id)
    {
        return $this->formatService->updateFormat($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->formatService->deleteFormat($id);
    }
}
