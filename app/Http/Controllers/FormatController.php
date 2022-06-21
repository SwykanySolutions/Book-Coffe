<?php

namespace App\Http\Controllers;

use App\Http\Requests\Format\CreateFormatRequest;
use App\Http\Requests\Format\UpdateFormatRequest;
use App\Services\FormatService;

class FormatController extends Controller
{
    private $format;

    public function __construct(FormatService $format)
    {
        $this->format = $format;
        $this->middleware('auth:sanctum')->only('store', 'update', 'destroy');
    }

    public function store(CreateFormatRequest $request)
    {
        return $this->format->createFormat($request->all());
    }

    public function update(UpdateFormatRequest $request, $id)
    {
        return $this->format->updateFormat($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->format->deleteFormat($id);
    }
}
