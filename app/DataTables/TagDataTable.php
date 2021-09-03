<?php

namespace App\DataTables;

use App\Interfaces\Blog\TagInterface;
use Yajra\DataTables\Services\DataTable;

class TagDataTable extends DataTable
{

    private $language;

    public function __construct()
    {

        $this->language = app()->getLocale();
    }


    public function dataTable($query)
    {
        return datatables($query)
            ->rawColumns(['tag', 'deleted_at', 'action'])
            ->editColumn('tag', function ($data) {

                $spanishContent = $data->getTranslation('tag', 'es');
                $translation = $data->getTranslation('tag', $this->language);

                if ($this->language === 'es')
                    return $spanishContent;


                if ($translation === $spanishContent) {
                    $translation = 'Sin traducción';
                }

                $content = <<<CONTENT
                
                <div class="text-primary font-weight-bold">$translation</div>
                <div class="font-weight-bold text-secondary-two">
                   <div class="d-inline-block iti-flag mx mr-2"></div> 
                   <div class="d-inline-block">$spanishContent</div>
                </div>
                
CONTENT;

                return $content;

            })
            ->editColumn('deleted_at', function ($data) {


                if (empty($data->deleted_at))
                    return '<span class="badge badge-primary  p-2">Activo</span>';

                return '<span class="badge badge-danger p-2">Eliminado</span>';

            })
            ->addColumn('action', 'admin.blogs.tags.datatables_actions');
    }


    public function query(TagInterface $tagContract)
    {
        return $tagContract->paginate($this->request->all());
    }


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
            'Etiqueta' => ['name' => 'tag', 'data' => 'tag', 'class' => 'text-secondary-two'],
            'Status'   => ['name' => 'deleted_at', 'data' => 'deleted_at'],
        ];

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Tag_' . date('YmdHis');
    }
}
