<?php

namespace App\DataTables;

use Yajra\DataTables\Services\DataTable;
use App\Interfaces\Investment\TransactionInterface;

class TransactionDataTable extends DataTable
{
    public function __construct()
    {
    }


    public function dataTable($query)
    {
        return datatables($query)
            ->rawColumns(['id', 'amount', 'type', 'status', 'created_at'])
            ->editColumn('amount', function ($transaction){

                return '<span class="font-weight-bold h5">$'.number_format($transaction->amount, 2, '.', ',').'</span>';
            })
            ->editColumn('type', function ($transaction){
                switch ($transaction->type){
                    case 'deposit': $classname='success'; break;
                    case 'withdrawal': $classname='danger'; break;
                    case 'profit': $classname='primary'; break;

                }
                return '<h6><span class="badge badge-pill text-capitalize badge-'.$classname.'">'.__('api/transaction.' . $transaction->type).'</span></h6>';
            })
            ->editColumn('status', function ($transaction){
                return __('api/transaction.' . $transaction->status);
            })
            ->editColumn('created_at', function ($transaction){
                return $transaction->created_at;
            });
    }


    public function query(TransactionInterface $transactionContract)
    {
        return $transactionContract->paginate($this->investmentId);
    }


    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'language'   => [
                    'url' => '//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json'
                ],
                "lengthMenu" => [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Ver Todas"]],
                "pagingType" => "full_numbers",
                'dom'        => 'Blfrtip',
                'buttons'    => [
                    [
                        'extend'    => 'reload',
                        'className' => 'btn-floating btn-secondary btn-sm btn-rounded',
                        'text'      => '<i class="fas fa-sync"></i>'
                    ]
                ],
                'order' => [[0, 'desc']],
                'scrollX'    => false,
                'responsive' => true,
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {

        return [
            'id' => ['name' => 'id', 'data' => 'id', 'class' => 'text-secondary-two', 'title' => 'Id'],
            'amount' => ['name' => 'amount', 'data' => 'amount', 'class' => 'text-secondary-two', 'title' => 'Monto'],
            'type'   => ['name' => 'type', 'data' => 'type', 'title'=>'Tipo'],
            'status'   => ['name' => 'status', 'data' => 'status', 'title'=>'status'],
            'created_at'   => ['name' => 'created_at', 'data' => 'created_at', 'title'=>'Fecha'],
        ];

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Transaction_' . date('YmdHis');
    }

    public function editors(){
        return [$this->user];
    }
}
