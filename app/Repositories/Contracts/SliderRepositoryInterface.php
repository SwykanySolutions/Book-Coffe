<?php

namespace App\Repositories\Contracts;

interface SliderRepositoryInterface
{
    public function getAllSlider();
    public function getSliderbyId(int $id);
    public function createSlider(array $request);
    public function updateSlider(int $id, array $request);
    public function deleteSlider(int $id);
}
