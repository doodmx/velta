<?php

namespace App\Http\Controllers\Api\Investment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Investment\PlanInterface;
use App\Http\Resources\Investment\PlanCollection;

class PlanController extends Controller
{

    private $plans;

    public function __construct(PlanInterface $planContract)
    {
        $this->plans = $planContract;
    }

    public function allActive()
    {

        $plans = $this->plans->allActive();
        return new PlanCollection($plans);
    }


}
