<?php

namespace App\Http\Controllers;

use App\Services\SliderService;
use Illuminate\Http\Request;
use App\Http\Requests\Slider\CreateSliderRequest;
use App\Http\Requests\Slider\UpdateSliderRequest;

class SliderController extends Controller
{
    protected $sliderService;

    public function __construct(SliderService $sliderService)
    {
        $this->sliderService = $sliderService;
        $this->middleware(['auth:sanctum', 'access.control'])->only('store', 'update', 'destroy');
    }

    public function index()
    {
        return $this->sliderService->getAllSlider();
    }

    public function store(CreateSliderRequest $request)
    {
        return $this->sliderService->createSlider($request);
    }

    public function show(int $id)
    {
        return $this->sliderService->getSliderbyId($id);
    }

    public function update(UpdateSliderRequest $request, int $id)
    {
        return $this->sliderService->updateSlider($id, $request);
    }

    public function destroy(int $id)
    {
        return $this->sliderService->deleteSlider($id);
    }
}
