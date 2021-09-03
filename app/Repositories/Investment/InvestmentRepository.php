<?php

namespace App\Repositories\Investment;

use DB;
use App\Models\Investment\Investment;
use App\Interfaces\Investment\InvestmentInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\Investment\InvestmentNotFoundException;

class InvestmentRepository implements InvestmentInterface
{

    private $investment;

    public function __construct()
    {
        $this->investment = app()->make(Investment::class);
    }

    public function show($investmentId)
    {
        try {
            $investment = $this->investment->find($investmentId);

            return $investment;
        } catch (ModelNotFoundException $exception) {

            throw new InvestmentNotFoundException();
        }
    }

    public function allByStatus($userId, $status = null)
    {

        $investments = $this->investment
            ->select([
                'investment.id',
                'investment.user_id',
                'investment.plan_id',
                'investment.currency_id',
                'investment.start_date',
                'investment.end_date',
                //'investment.balance',
                'investment.profit_percentage',
                'investment.period_in_years',
                'investment.status',
                DB::raw('SUM(IF(transaction.type = "profit" and transaction.status="applied", transaction.amount, 0))  as profit'),
                DB::raw('SUM(IF(transaction.type = "deposit" and transaction.status="applied", transaction.amount, 0))  as balance'),
                DB::raw('SUM(IF(transaction.type = "withdrawal" and transaction.status="applied", transaction.amount, 0))  as withdrawal'),
            ])
            ->join('transaction', 'transaction.investment_id', '=', 'investment.id', 'left outer')
            ->with(['reports', 'transactions' => function ($query) {
                $query->where('status', 'applied');
            }])
            ->where('user_id', $userId)
            ->when($status, function ($query) use ($status) {
                return $query->where('investment.status', $status);
            })
            ->orderBy('investment.created_at', 'desc')
            ->get();


        return $investments;
    }


    public function showTransactions($userId, $investmentId)
    {
        try {

            $investment = $this->investment
                ->where('user_id', $userId)
                ->where('id', $investmentId)
                ->with('transactions')
                ->firstOrFail();

            return $investment;

        } catch (ModelNotFoundException  $exception) {
            throw new InvestmentNotFoundException();
        }
    }

}
