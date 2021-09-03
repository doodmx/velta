<?php

namespace App\Repositories\Helpers;

use App\Interfaces\Helpers\StorageInterface;
use Illuminate\Support\Facades\Storage;

class StorageRepository implements StorageInterface
{

    /**
     * @param $path
     * @param $file
     * @return String
     */
    public function save($path, $file, $lastFile = null): String
    {
        if ($lastFile) {
            $pathLastFile = 'public/'.$lastFile;
            Storage::delete($pathLastFile);
        }

        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $fullPath = $path . clean_file_name($fileName) . '.' . $file->getClientOriginalExtension();

        Storage::disk('local')->put('public/' . $fullPath, file_get_contents($file));


        return $fullPath;


    }

    /**
     * @param $path
     */
    public function delete($file)
    {

        Storage::disk('local')->delete('public/' . $file);

    }


}
