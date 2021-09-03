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

class StatusComposer
{


    public function compose(View $view)
    {


        $status = ['all' => 'Ver Todos', '' => 'Activos', 'deleted' => 'Eliminados'];
        $view->with('statusSelect', $status);
    }
}
