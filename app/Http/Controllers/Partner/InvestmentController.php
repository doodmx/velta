<?php

namespace App\Http\Controllers\Partner;

use App\DataTables\UserDatatable;
use App\Interfaces\User\RoleInterface;
use App\Interfaces\User\UserInterface;
use App\Http\Controllers\Controller;

class InvestmentController extends Controller
{
    protected $user, $role;

    public function __construct(UserInterface $user, RoleInterface $role)
    {
        $this->user = $user;
        $roles = $role->allActive();

        view()->share('roleSelect', $roles->pluck('name', 'name'));

    }

    /**
     * @param UserDatatable $userDatatable
     * @return mixed
     */
    public function index(UserDatatable $userDatatable)
    {
        request()->request->add(['partner_id' => auth()->user()->id]);
        return $userDatatable->render('partner.investments.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register')
            ->with('title', 'Carga la información de tu inversionista.');
    }

}
