<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Services\CategoryService;

class CategoryController extends Controller
{

    private $category;

    public function __construct(CategoryService $category)
    {
        $this->category = $category;
        $this->middleware('auth:sanctum')->only('store', 'update', 'destroy');
    }

    public function store(CreateCategoryRequest $request)
    {
        return $this->category->creteCategory($request->all());
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        return $this->category->updateCategory($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->category->deleteCategory($id);
    }
}
