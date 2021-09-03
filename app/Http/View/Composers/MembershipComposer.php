<?php
/**
 * Created by PhpStorm.
 * User: josejesus
 * Date: 2020-06-01
 * Time: 16:01
 */

namespace App\Http\View\Composers;

use Illuminate\View\View;

class MembershipComposer
{

    public function compose(View $view)
    {


        $memberships = config('memberships');

        $view->with('membershipSelect', $memberships);
    }
}
