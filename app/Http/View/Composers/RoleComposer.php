<?php
/**
 * Created by PhpStorm.
 * User: josejesus
 * Date: 2020-06-01
 * Time: 16:01
 */

namespace App\Http\View\Composers;

use App\Interfaces\User\RoleInterface;
use Illuminate\View\View;

class RoleComposer
{

    private $roles;

    public function __construct(RoleInterface $roleContract)
    {

        $this->roles = $roleContract;
    }


    public function compose(View $view)
    {


        $roles = $this->roles->allActive();

        $view->with('roleSelect', $roles->pluck('name', 'name'));
    }
}
