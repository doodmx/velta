<?php

namespace App\Http\Controllers\Blog;

use App\Models\Blog\Blog;
use App\DataTables\BlogDataTable;
use App\Http\Controllers\Controller;
use App\Interfaces\Blog\BlogInterface;
use Illuminate\Database\QueryException;
use App\Http\Resources\Blog\BlogResource;
use App\Http\Requests\Blog\CreateBlogRequest;
use App\Http\Requests\Blog\UpdateBlogRequest;
use App\Interfaces\Helpers\StorageInterface;


class BlogController extends Controller
{


    private $blogs, $files;


    public function __construct(BlogInterface $blogContract, StorageInterface $storageContract)
    {

        $this->blogs = $blogContract;
        $this->files = $storageContract;


    }


    public function index(BlogDataTable $blogDataTable)
    {

        return $blogDataTable->render('admin.blogs.index');
    }

    public function create()
    {

        return view('admin.blogs.create');

    }


    /**
     * @param CreateBlogRequest $request
     * @return BlogResource
     */
    public function store(CreateBlogRequest $request)
    {


        $data = $request->all();

        $blogImagePath = $this->files->save('blogs/', $request->file('blog')["detail_image"]);
        $data['blog']['detail_image'] = $blogImagePath;


        $storedBlog = $this->blogs->store($data);

        return new BlogResource($storedBlog);


    }

    public function edit($id)
    {

        $blog = $this->blogs->showById($id);
        return view('admin.blogs.create')
            ->with([
                'blog'     => $blog,
                'postDate' => [
                    'year'  => intval($blog->date_to_publish->format('Y')),
                    'month' => intval($blog->date_to_publish->format('m')) - 1,
                    'day'   => $blog->date_to_publish->format('d'),
                ]
            ]);


    }

    public function update($id, UpdateBlogRequest $request)
    {

        $data = $request->all();
        $files = $request->allFiles();

        if (!empty($files)) {

            $blogImagePath = $this->files->save('blogs/', $request->file('blog')["detail_image"]);
            $data['blog']['detail_image'] = $blogImagePath;

        }


        $updatedBlog = $this->blogs->update($id, $data);
        return new BlogResource($updatedBlog);


    }


    public function deleteImage($id, $type)
    {
        $blog = Blog::find($id);
        if (empty($blog))
            return response()->json(["msg" => "Blog no encontrado"], 404);

        try {


            $this->files->delete('public/blogs/' . $blog->detail_image);

            $blog->update([
                'detail_image' => null
            ]);

            return response()->json(["message" => "Imagen eliminada correctamente"], 200);

        } catch (QueryException $e) {
            return response()->json(["message" => "Hubo un error al eliminar la imagen " . $e->getMessage()], 500);

        }
    }


}
