<?php

namespace App\Repositories\Contracts;

use App\Models\Category;

interface CategoryRepositoryInterface
{
    public function getCategorybyId(int $id);
    public function creteCategory(array $request);
    public function updateCategory(array $request, int $id);
    public function deleteCategory(Category $category);
}
