<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{

    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getAllCategory()
    {
        return $this->category->all();
    }

    public function getCategorybyId(int $id)
    {
        return $this->category->find($id);
    }

    public function creteCategory(array $request)
    {
        return $this->category->create($request);
    }

    public function updateCategory(array $request, int $id)
    {
        $category = $this->category->find($id);
        $category->update($request);
        return $this->category->find($id);
    }

    public function deleteCategory(Category $category)
    {
        $category->delete();
    }

}
