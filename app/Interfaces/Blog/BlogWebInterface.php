<?php

namespace App\Interfaces\Blog;

interface BlogWebInterface
{

    public function paginatePublished(int $rowsPerPage, $filter);

    public function oldPublishedPosts(int $limit);

    public function showBySlug(string $slug);

    public function relatedPosts($blog, int $limit);

    public function publishPostsFromDate($date,$time);


}
