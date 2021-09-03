<?php

namespace App\Interfaces\Blog;

interface TagInterface
{


    public function paginate($filter);

    public function allActive();

    public function store($data);

    public function show($id);

    public function update($id, $data);

    public function restore($id);

    public function delete($id);


}
