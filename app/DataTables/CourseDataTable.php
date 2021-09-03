<?php

namespace App\DataTables;

use App\Interfaces\Course\CourseInterface;
use Yajra\DataTables\Services\DataTable;

class CourseDataTable extends DataTable
{

    private $language;

    public function __construct()
    {

        $this->language = app()->getLocale();

    }

    public function dataTable($query)
    {
        return datatables($query)
            ->rawColumns(['thumbnail', 'name', 'deleted_at', 'action'])
            ->editColumn('thumbnail', function ($data) {

                if ($data->thumbnail == null)
                    return '<i class="fas fa-image text-primary fa-2x"></i>';

                return '<img class="profile-avatar shadow" src="' . asset('storage/' . $data->thumbnail) . '">';
            })
            ->editColumn('name', function ($data) {

                $spanishContent = $data->getTranslation('name', 'es');
                $translation = $data->getTranslation('name', $this->language);



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
                    return '<span class="badge badge-primary text-tangaroa p-2">Activo</span>';

                return '<span class="badge badge-secondary p-2">Eliminado</span>';

            })
            ->addColumn('action', 'admin.courses.datatables_actions');
    }


    public function query(CourseInterface $courseContract)
    {

        $courses = $courseContract->paginate($this->request->all());
        return $courses;


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
                "lengthMenu" => [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Ver Todos"]],
                "pagingType" => "full_numbers",
                'dom'        => 'Blfrtip',
                'buttons'    => [
                    [
                        'extend'    => 'reload',
                        'className' => 'btn-floating btn-secondary btn-sm btn-rounded text-dark',
                        'text'      => '<i class="fas fa-sync"></i>'
                    ],

                ],
                'scrollX'    => false,
                'responsive' => true,
                'order'      => [
                    [3, 'desc']
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
            'Miniatura'          => ['name' => 'thumbnail', 'data' => 'thumbnail', "class" => "text-center"],
            'Nombre'             => ['name' => 'name', 'data' => 'name', 'class' => "text-secondary-two"],
            'Status'             => ['name' => 'deleted_at', 'data' => 'deleted_at', "class" => "text-center text-secondary-two"],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Cursos_' . date('YmdHis');
    }
}
