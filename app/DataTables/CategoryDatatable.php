<?php

namespace App\DataTables;

use Yajra\DataTables\Services\DataTable;
use App\Interfaces\Blog\CategoryInterface;

class CategoryDatatable extends DataTable
{


    private $language;

    public function __construct()
    {

        $this->language = app()->getLocale();
    }

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->rawColumns(['category', 'deleted_at', 'action'])
            ->editColumn('category', function ($data) {

                $spanishContent = $data->getTranslation('category', 'es');
                $translation = $data->getTranslation('category', $this->language);

                if ($this->language === 'es')
                    return $spanishContent;


                if ($translation === $spanishContent) {
                    $translation = 'Sin traducción';
                }

                $content = <<<CONTENT
                
                <div class="text-primary font-weight-bold">$translation</div>
                <div class="font-weight-bold">
                   <div class="d-inline-block iti-flag mx mr-2"></div> 
                   <div class="d-inline-block text-secondary-two">$spanishContent</div>
                </div>
                
CONTENT;

                return $content;

            })
            ->editColumn('deleted_at', function ($data) {

                if (empty($data->deleted_at))
                    return '<span class="badge badge-primary p-2">Activo</span>';

                return '<span class="badge badge-danger p-2">Eliminado</span>';

            })
            ->addColumn('action', 'admin.blogs.categories.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Category $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CategoryInterface $categoryContract)
    {
        return $categoryContract->paginate($this->request->all());
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
            ->addAction(['width' => '250px'])
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
                'scrollX'    => false,
                'responsive' => true,
                'order'      => [
                    [0, 'asc']
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
            'Categoría' => ['name' => 'category', 'data' => 'category'],
            'Status'    => ['name' => 'deleted_at', 'data' => 'deleted_at'],
        ];

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Category_' . date('YmdHis');
    }
}
