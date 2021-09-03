<?php

namespace App\DataTables;

use App\Interfaces\Blog\BlogInterface;
use Yajra\DataTables\Services\DataTable;

class BlogDataTable extends DataTable
{


    private $language;

    public function __construct()
    {

        $this->language = app()->getLocale();

    }


    public function dataTable($query)
    {
        return datatables($query)
            ->rawColumns(['detail_image', 'title', 'category', 'status', 'action'])
            ->editColumn('date_to_publish', function ($data) {
                return $data->date_to_publish->format('d F Y') . ' ' . $data->time_to_publish->format('h:i a');
            })
            ->editColumn('detail_image', function ($data) {

                if ($data->detail_image == null)
                    return '<i class="fas fa-image text-primary fa-2x"></i>';

                return '<img class="img-fluid mx-auto d-block shadow" style="height:60px;width:60px; border-radius:50%;object-fit:cover;" src="' . asset('storage/' . $data->detail_image) . '">';
            })
            ->editColumn('title', function ($data) {

                $spanishContent = $data->getTranslation('title', 'es');
                $translation = $data->getTranslation('title', $this->language);

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
            ->editColumn('status', function ($data) {

                $color = $data->status == 1 ? 'primary' : 'secondary';
                $text = $data->status == 1 ? 'publicado' : 'por publicar';

                return '<span class="badge badge-' . $color . ' p-2">' . $text . '</span>';
            })
            ->addColumn('action', 'admin.blogs.datatables_actions');
    }


    public function query(BlogInterface $blogContract)
    {

        $blogs = $blogContract->paginate($this->request->all());

        return $blogs;


    }


    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '100px','text-align'=>'right'])
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
                    [2, 'desc']
                ]
            ]);
    }


    protected function getColumns()
    {

        $blogName = !$this->showLanguageColumn ? 'Título' : 'Original';


        return [
            'Imagen'             => ['name' => 'detail_image', 'data' => 'detail_image', "class" => "text-center"],
            'Título'             => ['name' => 'title', 'data' => 'title', 'class' => 'text-secondary-two'],
            'Fecha de publicación' => ['name' => 'date_to_publish', 'data' => 'date_to_publish', "class" => "text-center text-secondary-two"],
            'Status'             => ['name' => 'status', 'data' => 'status']
        ];
    }


    protected function filename()
    {
        return 'Blog_' . date('YmdHis');
    }
}
