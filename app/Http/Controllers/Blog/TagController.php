<?php

namespace App\Http\Controllers\Blog;

use App\Models\Blog\Tag;
use App\DataTables\TagDataTable;
use App\Http\Controllers\Controller;
use App\Interfaces\Blog\TagInterface;
use Illuminate\Database\QueryException;
use App\Http\Requests\Blog\CreateTagRequest;
use App\Http\Requests\Blog\UpdateTagRequest;


class TagController extends Controller
{


    private $tags;

    public function __construct(TagInterface $tagContract)
    {
        $this->tags = $tagContract;
    }


    public function index(TagDataTable $tagsDataTable)
    {
        return $tagsDataTable->render('admin.blogs.tags.index');
    }


    public function store(CreateTagRequest $request)
    {

        $tag = $this->tags->store($request->all());

        return response()->json(['tag' => $tag], 201);

    }

    public function show($id)
    {

        $tag = $this->tags->show($id);

        return response()->json(['tag' => $tag], 200);
    }

    public function update(UpdateTagRequest $request, $id)
    {
        $tag = $this->tags->update($id, $request->all());

        return response()->json(['tag' => $tag], 200);
    }


    public function restore($id)
    {

        $this->tags->restore($id);

        return response()->json(['message' => 'Etiqueta restaurada correctamente'], 200);

    }


    public function delete($id)
    {

        $this->tags->delete($id);

        return response()->json(null, 204);

    }


}
