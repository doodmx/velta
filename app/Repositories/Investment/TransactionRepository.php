<?php

namespace App\Repositories\Investment;

use App\Models\Investment\Transaction;
use App\Interfaces\Investment\TransactionInterface;

class TransactionRepository implements TransactionInterface
{

    private $transaction;

    public function __construct()
    {
        $this->transaction = app()->make(Transaction::class);
    }

    public function paginate($investmentId)
    {

        $transactions = $this->transaction
            ->where('investment_id', $investmentId);

        return $transactions;
    }

    public function create($data)
    {
        try {
            $transaction = $this->transaction->create($data);
            $transaction->status = 'applied';
            $transaction->save();

            return $transaction;
        } catch (QueryException $e) {
            throw new DatabaseException('Hubo un error al guardar la etiqueta, intenta nuevamente');
        }
    }
}
