<?php

namespace App\Models\Partner;

use App\Interfaces\Partner\Resource;

class PartnerResource implements Resource
{

    private $resource;

    public function __construct(Resource $resource)
    {

        $this->resource = $resource;
    }


    public function setResource(Resource $resource)
    {
        $this->resource = $resource;
    }

    public function enable($data)
    {

       return $this->resource->enable($data);

    }

}
