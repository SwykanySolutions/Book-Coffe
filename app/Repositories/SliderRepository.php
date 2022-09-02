<?php

namespace App\Repositories;

use App\Repositories\Contracts\SliderRepositoryInterface;
use App\Models\Slider;

class SliderRepository implements SliderRepositoryInterface
{
	protected $slider;

	public function __construct(Slider $slider)
	{
		$this->slider = $slider;
	}

	public function getAllSlider() 
	{
		return $this->slider->all();
	}

    public function getSliderbyId(int $id)
    {
    	return $this->slider->find($id);
    }

    public function createSlider(array $request)
    {
        return $this->slider->create($request);
    }

    public function updateSlider(int $id, array $request)
    {
        $slider = $this->slider->find($id);
        return $slider->update($request);
    }

    public function deleteSlider(int $id)
    {
    	$slider = $this->slider->find($id);
    	return $slider->delete();
    }
}
