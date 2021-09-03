<?php

namespace App\DataTables;

use App\Interfaces\Payment\PaymentInterface;
use Yajra\DataTables\Services\DataTable;

class PaymentDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables($query)
            ->rawColumns(['action'])
            ->editColumn('created_at', function ($data) {


                return $data->created_at->format('d/m/Y h:i a');

            })
            ->addColumn('action', 'admin.payments.datatables_actions');
    }


    public function query(PaymentInterface $paymentContract)
    {

        $payments = $paymentContract->paginate($this->request->all());

        return $payments;


    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '10%', 'className' => 'text-right'])
            ->parameters([
                'language'   => [
                    'url' => '//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json'
                ],
                "lengthMenu" => [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Ver Todos"]],
                "pagingType" => "full_numbers",
                'dom'        => 'Blfrtip',
                'buttons'    => [
                    [
                        'extend'    => 'reload',
                        'className' => 'btn-floating btn-secondary btn-sm btn-rounded',
                        'text'      => '<i class="fas fa-sync"></i>'
                    ]
                ],
                'scrollX'    => false,
                'responsive' => true,
                'order'      => [
                    [5, 'desc']
                ]
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
            'Importe' => ['name' => 'total', 'data' => 'total', "class" => "text-center text-secondary-two"],
            'Moneda'  => ['name' => 'iso_code', 'data' => 'iso_code', 'class' => "text-secondary-two"],
            'UUID'    => ['name' => 'payment_uuid', 'data' => 'payment_uuid', "class" => "text-center text-secondary-two"],
            'Cliente' => ['name' => 'buyer', 'data' => 'buyer', "class" => "text-center text-secondary-two"],
            'Status'  => ['name' => 'status', 'data' => 'status', "class" => "text-center text-secondary-two"],
            'Fecha'   => ['name' => 'created_at', 'data' => 'created_at', "class" => "text-center text-secondary-two"],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Pagos ' . date('YmdHis');
    }
}
