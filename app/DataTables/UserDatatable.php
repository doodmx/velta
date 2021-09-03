<?php

namespace App\DataTables;

use DB;
use App\Interfaces\User\UserInterface;
use Yajra\DataTables\Services\DataTable;

class UserDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->rawColumns(['photo', 'lastname', 'contact', 'action', 'profile'])
            ->editColumn('photo', function ($user) {

                $src = 'https://cdn.veltacorp.com/img/user.png';

                if (!empty($user->profile->photo)) {
                    $src = asset($user->profile->photo);
                }

                return '<img src="' . $src . '" alt="Avatar" class="profile-avatar">';

            })
            ->editColumn('partner_id', function ($user) {

                if ($user->roles[0]['name'] !== 'Investment') {
                    return '-';
                }
                if (!empty($user->owner)) {
                    return $user->owner->lastname . ' ' . $user->owner->name;
                }

                return 'Velta';
            })
            ->editColumn('lastname', function ($user) {

                $fullName = $user->profile->lastname . ' ' . $user->profile->name;

                if ($user->roles[0]['name'] === 'Partner') {

                    return <<<HTML
                    <div class="d-flex align-items-center">
                        <div class="circle circle-xs {$user->membership}"></div>
                        <div class="ml-2 text-uppercase text-secondary-two font-weight-bold">   
                            {$user->membership}
                        </div>
                    </div>
                    <div class="mt-2">
                        {$fullName}
                    </div>
                    
HTML;
                }


                return $fullName;
            })
            ->editColumn('partner_id', function ($user) {

                if ($user->roles[0]['name'] !== 'Investment') {
                    return '-';
                }
                if (!empty($user->owner)) {
                    return $user->owner->lastname . ' ' . $user->owner->name;
                }

            })
            ->editColumn('contact', function ($user) {
                $emailButton = <<<HTML
                <p class="p-0 m-0">
                    <a class="text-secondary-two" href="mailto:{$user->email}" target="_blank">
                        <i class="far fa-envelope h5-responsive mr-1 text-secondary"></i>{$user->email}
                    </a>
                </p>
HTML;

                $whatsAppButton = <<<HTML
                <p class="p-0 mt-1">
                    <a class="text-secondary-two" href="https://api.whatsapp.com/send?phone={$user->profile->whatsapp}&text=¡Hola buen día!" target="_blank">
                        <i class="fab fa-whatsapp h5-responsive text-secondary mr-1"> </i>{$user->profile->whatsapp}
                    </a>
                </p>
HTML;

                return $whatsAppButton . $emailButton;
            })
            ->addColumn('action', 'admin.users.datatables_actions');
    }


    /**
     * Get query source of dataTable.
     *
     * @param UserInterface $user
     * @return mixed
     */
    public function query(UserInterface $user)
    {
        $users = $user->paginate($this->request->all());
        return $users;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {

        $i18n = [
            'es' => '//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json',
            'en' => '//cdn.datatables.net/plug-ins/1.10.21/i18n/English.json'
        ];
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '20px', 'className' => 'text-right'])
            ->parameters([
                'language'   => [
                    'url' => $i18n[app()->getLocale()]
                ],
                'lengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50, 100, __('my_investors.view_all')]],
                'pagingType' => 'full_numbers',
                'dom'        => 'Blfrtip',
                'scrollX'    => false,
                'order'      => [
                    [1, 'asc']
                ],
                'buttons'    => [
                    [
                        'extend'    => 'reload',
                        'className' => 'btn-floating btn-secondary btn-sm btn-rounded',
                        'text'      => '<i class="fas fa-sync"></i>'
                    ],
                    [
                        'extend'    => 'copy',
                        'text'      => '<i class="fas fa-clipboard"></i>',
                        'className' => 'btn-floating btn-secondary btn-sm btn-rounded'
                    ],
                    [
                        'extend'    => 'excel',
                        'text'      => '<i class="fas fa-file-excel"></i>',
                        'className' => 'btn-floating btn-secondary btn-sm btn-rounded '
                    ],
                ],
                'scrollX'    => false,
                'responsive' => true
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
            'photo'           => [
                'name'       => 'profile.photo',
                'data'       => 'photo',
                'title'      => 'Imagen',
                'className'  => 'text-secondary-two',
                'orderable'  => false,
                'exportable' => false,
                'visible'    => request()->route()->getName() === 'users.index'
            ],
            'id_card'         => [
                'name'       => 'profile.id_card',
                'data'       => 'id_card',
                'visible'    => false,
                'exportable' => false
            ],
            'proof_residence' => [
                'name'       => 'profile.proof_residence',
                'data'       => 'proof_residence',
                'visible'    => false,
                'exportable' => false
            ],
            'lastname'        => [
                'name'      => 'profile.lastname',
                'data'      => 'lastname',
                'title'     => __('my_investors.name'),
                'className' => 'text-secondary-two align-middle',
                'width'     => '200px'
            ],
            'name'            => [
                'name'       => 'profile.name',
                'data'       => 'name',
                'title'      => __('my_investors.name'),
                'className'  => 'text-secondary-two',
                'visible'    => false,
                'exportable' => false
            ],
            'role'            => [
                'name'       => 'roles',
                'data'       => 'roles.0.name',
                'title'      => 'Rol',
                'className'  => 'text-secondary-two text-left align-middle',
                'orderable'  => false,
                'searchable' => false,
                'visible'    => request()->route()->getName() === 'users.index'
            ],
            'contact'         => [
                'name'       => 'profile.whatsapp',
                'data'       => 'contact',
                'title'      => __('my_investors.contact'),
                'className'  => 'text-secondary-two text-left',
                'orderable'  => false,
                'exportable' => false
            ],

            'whastapp' => [
                'name'    => 'profile.whatsapp',
                'data'    => 'profile.whatsapp',
                'title'   => 'Teléfono',
                'visible' => false,
            ],

            'email'   => [
                'name'    => 'email',
                'data'    => 'email',
                'title'   => 'Correo Electrónico',
                'visible' => false,
            ],
            'partner' => [
                'name'       => 'partner_id',
                'data'       => 'partner_id',
                'title'      => 'Partner',
                'className'  => 'text-secondary-two align-middle',
                'orderable'  => false,
                'searchable' => false,
                'width'      => '200px',
                'visible'    => request()->route()->getName() === 'users.index'
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }
}
