<?php

namespace App\Interfaces\Helpers;

interface StorageInterface
{
    /**
     * @param $path
     * @param $file
     * @return String
     */
    public function save($path, $file): String;

    /**
     * @param $path
     */
    public function delete($path);
}
