<?php

namespace App\DataTables;

use Yajra\DataTables\Services\DataTable;
use App\Interfaces\Investment\ReportInterface;

class ReportDataTable extends DataTable
{

    public function __construct()
    {
    }


    public function dataTable($query)
    {
        return datatables($query)
            ->rawColumns(['id', 'file', 'note', 'created_at', 'action'])
            ->editColumn('file', function ($report) {

                return '<a href="' . asset('storage/'.$report->file) . '" target="_blank"  class="btn btn-outline-primary btn-rounded waves-effect btn-sm"> <i class="fas fa-download"></i> Download</a>';
                // return '<a href="' . asset($report->file) . '" target="_blank">' . $report->file . '</a>';
            })
            ->editColumn('created_at', function ($transaction) {
                return $transaction->created_at;
            })
            ->addColumn('action', 'admin.users.investment.reports.datatable_actions');
    }


    public function query(ReportInterface $reportContract)
    {
        return $reportContract->paginate($this->investmentId);
    }


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
                'responsive' => true,
                'scrollX'    => false,
                'order'      => [[0, 'desc']],
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
            'id'         => ['name' => 'id', 'data' => 'id', 'class' => 'text-secondary-two', 'title' => 'Id'],
            'file'       => ['name' => 'file', 'data' => 'file', 'class' => 'text-secondary-two', 'title' => 'Archivo'],
            'note'       => ['name' => 'note', 'data' => 'note', 'title' => 'Nota'],
            'created_at' => ['name' => 'created_at', 'data' => 'created_at', 'title' => 'Fecha'],
        ];

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Report_' . date('YmdHis');
    }
}
