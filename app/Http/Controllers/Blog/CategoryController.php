<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\DataTables\CategoryDatatable;
use App\Interfaces\Blog\CategoryInterface;
use App\Http\Requests\Blog\CreateCategoryRequest;
use App\Http\Requests\Blog\UpdateCategoryRequest;

class CategoryController extends Controller
{
    private $categories;

    public function __construct(CategoryInterface $categoryContract)
    {
        $this->categories = $categoryContract;
    }


    public function index(CategoryDatatable $categoryDatatable)
    {
        return $categoryDatatable->render('admin.blogs.categories.index');
    }


    public function store(CreateCategoryRequest $request)
    {

        $category = $this->categories->store($request->all());

        return response()->json(['category' => $category], 201);

    }

    public function show($id)
    {

        $category = $this->categories->show($id);

        return response()->json(['category' => $category], 200);
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = $this->categories->update($id, $request->all());

        return response()->json(['category' => $category], 200);
    }


    public function restore($id)
    {

        $this->categories->restore($id);

        return response()->json(['message' => 'Categoría restaurada correctamente'], 200);

    }


    public function delete($id)
    {

        $this->categories->delete($id);

        return response()->json(null, 204);

    }
}
