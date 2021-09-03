<?php
/**
 * Created by PhpStorm.
 * User: josejesus
 * Date: 2020-06-16
 * Time: 10:14
 */

namespace App\Repositories\Investment;


use App\Models\Investment\Plan;
use App\Interfaces\Investment\PlanInterface;

class PlanRepository implements PlanInterface
{

    private $plan;

    public function __construct()
    {
        $this->plan = app()->make(Plan::class);
    }

    public function allActive()
    {


        $plans = $this->plan
            ->where('name->' . app()->getLocale(), '<>', '')
            ->with('currency')
            ->get();

        return $plans;
    }

}
