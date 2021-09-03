<?php
/**
 * Created by PhpStorm.
 * User: josejesus
 * Date: 2020-06-01
 * Time: 16:01
 */

namespace App\Http\View\Composers;

use Illuminate\View\View;

class LanguageComposer
{

    public function compose(View $view)
    {


        $configLanguages = config('locale.languages');
        foreach ($configLanguages as $key => $configLanguage) {
            $configLanguages[$key] = $configLanguage[4];
        }

        $view->with('languages', $configLanguages);
    }
}
