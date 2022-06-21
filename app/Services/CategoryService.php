<?php

namespace App\Services;

use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryService
{

    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function creteCategory(array $request)
    {
        return $this->creteCategory($request);
    }

    public function updateCategory(array $request, int $id)
    {
        return $this->categoryRepository->updateCategory($request, $id);
    }

    public function deleteCategory(int $id)
    {
        $user = auth()->user();
        if($user->delete_category || $user->owner){
            $category = $this->categoryRepository->getCategorybyId($id);
            if(!$category) return abort(404);
            $this->categoryRepository->deleteCategory($category);
        } else {
            return abort(403,'Unauthorized action.');
        }
    }

}
