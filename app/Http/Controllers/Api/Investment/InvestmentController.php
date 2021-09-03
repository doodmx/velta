<?php

namespace App\Http\Controllers\Api\Investment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Investment\InvestmentInterface;
use App\Http\Resources\Investment\InvestmentCollection;
use App\Http\Resources\Investment\Investment as InvestmentResource;


class InvestmentController extends Controller
{

    private $investments;

    public function __construct(InvestmentInterface $investmentContract)
    {
        $this->investments = $investmentContract;
    }

    public function allByStatus(Request $request)
    {

        $investments = $this->investments->allByStatus(auth()->user()->id, $request->get('status'));
        return new InvestmentCollection($investments);
    }


    public function showTransactions($investmentId)
    {

        $investment = $this->investments->showTransactions(auth()->user()->id, $investmentId);

        return new InvestmentResource($investment);

    }

}
