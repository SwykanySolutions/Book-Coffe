<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Services\CategoryService;

class CategoryController extends Controller
{

    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        $this->middleware('auth:sanctum')->only('store', 'update', 'destroy');
    }

    public function index()
    {
        return $this->categoryService->getAllCategory();
    }

    public function store(CreateCategoryRequest $request)
    {
        return $this->categoryService->creteCategory($request->all());
    }

    public function show(int $id)
    {
        return $this->categoryService->getCategoryByid($id);
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        return $this->categoryService->updateCategory($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->categoryService->deleteCategory($id);
    }
}
