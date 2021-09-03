<?php

namespace App\Repositories\Blog;

use App\Models\Blog\Category;
use Illuminate\Database\QueryException;
use App\Interfaces\Blog\CategoryInterface;
use App\Exceptions\Helpers\DatabaseException;
use App\Exceptions\Blog\CategoryNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryRepository implements CategoryInterface
{
    protected $category;

    public function __construct()
    {
        $this->category = app(Category::class);
    }

    public function paginate($filter)
    {

        $categories = $this->category->newQuery();

        if (isset($filter['category_status'])) {

            if ($filter['category_status'] == 'deleted')
                $categories->deleted();

            if ($filter['category_status'] == 'all')
                $categories->all();
        }
        return $categories;
    }

    public function allActive()
    {
        return $this->category
            ->byLocale()
            ->get();
    }

    public function store($data)
    {

        try {

            $category = $this->category->create($data);

            return $category;

        } catch (QueryException $e) {


            throw new DatabaseException('Hubo un error al guardar la categoría, intenta nuevamente');

        }
    }

    public function show($id)
    {

        try {

            $category = $this->category
                ->findOrFail($id);

            return $category;

        } catch (ModelNotFoundException $e) {
            throw new CategoryNotFoundException();
        }
    }

    public function update($id, $data)
    {

        try {

            $category = $this->show($id);
            $category->update($data);

            return $category;


        } catch (QueryException $e) {
            throw new DatabaseException('Hubo un error al actualizar la categoría');
        }

    }

    public function restore($id)
    {
        try {

            $category = $this->category->onlyTrashed()->findOrFail($id);
            $category->restore();

        } catch (ModelNotFoundException $e) {

            throw new CategoryNotFoundException();
        }


    }

    public function delete($id)
    {

        $category = $this->show($id);
        $category->delete();

    }
}
