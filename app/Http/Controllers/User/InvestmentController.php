<?php

namespace App\Http\Controllers\User;

use App\DataTables\TransactionDataTable;
use App\Http\Controllers\Controller;
use App\Interfaces\Investment\InvestmentInterface;
use App\Interfaces\User\UserInterface;

class InvestmentController extends Controller
{
    protected $user;
    protected $investment;

    public function __construct(UserInterface $userContract, InvestmentInterface $investmentContract)
    {
        $this->user = $userContract;
        $this->investment = $investmentContract;
    }

    public function show($userId)
    {
        $user = $this->user->showById($userId);
        $investment = $this->investment->allByStatus($userId);

        return view('admin.users.investment.show', [
            'user'       => $user,
            'investment' => $investment
        ]);
    }

    public function transactions($userId, $investmentId, TransactionDataTable $transactionDataTable){

        return $transactionDataTable
            ->with('investmentId', $investmentId)
            ->render('admin.users.investment.transactions.index');
    }

    public function reports($userId, $investmentId, TransactionDataTable $transactionDataTable){

        return $transactionDataTable
            ->with('investmentId', $investmentId)
            ->render('admin.users.investment.transactions.index');
    }
}
