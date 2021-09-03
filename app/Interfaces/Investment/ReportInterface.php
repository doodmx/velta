<?php

namespace App\Interfaces\Investment;

interface ReportInterface
{
    public function paginate($investmentId);

    public function create($data);

    public function delete($id);
}
