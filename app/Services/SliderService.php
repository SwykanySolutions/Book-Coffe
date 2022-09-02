<?php

namespace App\Services;

use App\Repositories\Contracts\SliderRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderService
{
	private $sliderRepository;

    public function __construct(SliderRepositoryInterface $slider)
    {
        $this->sliderRepository = $slider;
    }

    public function getAllSlider()
    {
        return $this->sliderRepository->getAllSlider();
    }

    public function getSliderbyId(int $id)
    {
        $slider = $this->sliderRepository->getSliderbyId($id);
        if(!$slider){
            abort(404);
        }
        return $slider;
    }

    public function createSlider(Request $request)
    {
        $infos = $request->all();
        if ($photo = $request->file('background_photo')) {
            $infos['background_photo'] = $photo->store('slider/background', 'public');
        }
        if ($photo = $request->file('title_photo')) {
            $infos['title_photo'] = $photo->store('slider/title', 'public');
        }
        return $this->sliderRepository->createSlider($infos);
    }

    public function updateSlider(int $id, Request $request)
    {
        $slider = $this->sliderRepository->getSliderbyId($id);
        if(!$slider){
            abort(404);
        }
        $infos = $request->all();
        if ($photo = $request->file('background_photo')) {
            if (Storage::disk('public')->exists($slider->background_photo)) {
                Storage::disk('public')->delete($slider->background_photo);
            }
            $infos['background_photo'] = $photo->store('slider/background', 'public');
        }
        if ($photo = $request->file('title_photo')) {
            if (Storage::disk('public')->exists($slider->title_photo)) {
                Storage::disk('public')->delete($slider->title_photo);
            }
            $infos['title_photo'] = $photo->store('slider/title', 'public');
        }
        $this->sliderRepository->updateSlider($id, $infos);
        return $this->sliderRepository->getSliderbyId($id);
    }

    public function deleteSlider(int $id)
    {
        $user = auth()->user();
        if ($user->delete_slider || $user->owner) {
            $slider = $this->sliderRepository->getSliderbyId($id);
            if(!$slider){
                abort(404);
            }
            if (Storage::disk('public')->exists($slider->background_photo)) {
                Storage::disk('public')->delete($slider->background_photo);
            }
            if (Storage::disk('public')->exists($slider->title_photo)) {
                Storage::disk('public')->delete($slider->title_photo);
            }
            return $this->sliderRepository->deleteSlider($id);
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }
}
