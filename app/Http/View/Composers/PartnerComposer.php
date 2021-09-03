<?php
/**
 * Created by PhpStorm.
 * User: josejesus
 * Date: 2020-06-01
 * Time: 16:01
 */

namespace App\Http\View\Composers;

use App\Interfaces\User\UserInterface;
use Illuminate\View\View;

class PartnerComposer
{

    private $users;

    public function __construct(UserInterface $userContract)
    {

        $this->users = $userContract;
    }


    public function compose(View $view)
    {

        $partners = $this->users->showAllByRole('Partner');
        $partners = $partners->mapWithKeys(function ($item) {
            return [$item->id => $item->profile->lastname . ' ' . $item->profile->name];
        });

        $view->with('partners', $partners);
    }
}
