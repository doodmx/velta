<?php

namespace App\Interfaces\Blog;

interface BlogInterface
{

    public function showAll();

    public function paginate($filter);

    public function store(array $data);

    public function showById(int $id);

    public function update(int $id, array $data);

    public function publishPostsFromDate($date, $time);


}
