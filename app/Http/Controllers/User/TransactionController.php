<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\DataTables\TransactionDataTable;
use App\Http\Requests\Investment\CreateTransactionRequest;
use App\Interfaces\Investment\InvestmentInterface;
use App\Interfaces\Investment\TransactionInterface;
use App\Interfaces\User\UserInterface;

class TransactionController extends Controller
{
    protected $user;
    protected $transaction;
    protected $investment;

    public function __construct(
        UserInterface $useContract,
        InvestmentInterface $investmentContract,
        TransactionInterface $transactionContract
    )
    {
        $this->user = $useContract;
        $this->investment = $investmentContract;
        $this->transaction = $transactionContract;

    }

    public function index($userId, $investmentId, TransactionDataTable $transactionDataTable)
    {
        $user = $this->user->showById($userId);
        $investment = $this->investment->allByStatus($userId);

        return $transactionDataTable
            ->with('investmentId', $investmentId)
            ->render('admin.users.investment.transactions.index', [
                'user'       => $user,
                'investment' => $investment
            ]);
    }

    public function store($userId, $investmentId,CreateTransactionRequest $request)
    {
        $this->transaction->create($request->all());
        $investment = $this->investment->allByStatus($userId);
        return response()->json($investment[0], 201);
    }
}
