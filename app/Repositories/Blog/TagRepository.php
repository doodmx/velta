<?php

namespace App\Repositories\Blog;

use App\Models\Blog\Tag;
use App\Interfaces\Blog\TagInterface;
use Illuminate\Database\QueryException;
use App\Exceptions\Blog\TagNotFoundException;
use App\Exceptions\Helpers\DatabaseException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TagRepository implements TagInterface
{
    protected $tag;

    public function __construct()
    {
        $this->tag = app(Tag::class);
    }


    public function paginate($filter)
    {

        $tags = $this->tag->newQuery();

        if (isset($filter['tag_status'])) {

            if ($filter['tag_status'] == 'deleted')
                $tags->deleted();

            if ($filter['tag_status'] == 'all')
                $tags->all();
        }
        return $tags;
    }

    public function allActive()
    {
        return $this->tag
            ->byLocale()
            ->get();
    }

    public function store($data)
    {

        try {

            $tag = $this->tag->create($data);

            return $tag;

        } catch (QueryException $e) {


            throw new DatabaseException('Hubo un error al guardar la etiqueta, intenta nuevamente');

        }
    }

    public function show($id)
    {

        try {

            $tag = $this->tag
                ->findOrFail($id);

            return $tag;

        } catch (ModelNotFoundException $e) {
            throw new TagNotFoundException();
        }
    }

    public function update($id, $data)
    {

        try {

            $tag = $this->show($id);
            $tag->update($data);

            return $tag;


        } catch (QueryException $e) {
            throw new DatabaseException('Hubo un error al actualizar la etiqueta');
        }

    }

    public function restore($id)
    {
        try {

            $tag = $this->tag->onlyTrashed()->findOrFail($id);
            $tag->restore();

        } catch (ModelNotFoundException $e) {

            throw new TagNotFoundException();
        }


    }

    public function delete($id)
    {

        $tag = $this->show($id);
        $tag->delete();

    }

}
