<?php
/**
 * Created by PhpStorm.
 * User: josejesus
 * Date: 2020-06-01
 * Time: 16:01
 */

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Interfaces\User\PermissionInterface;

class PermissionComposer
{

    private $permissions;

    public function __construct(PermissionInterface $permissionContract)
    {

        $this->permissions = $permissionContract;
    }


    public function compose(View $view)
    {


        $permissions = $this->permissions->allActive();

        $view->with('permissions', $permissions);
    }
}
