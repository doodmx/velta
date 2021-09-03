<?php
/**
 * Created by PhpStorm.
 * User: josejesus
 * Date: 2020-06-01
 * Time: 16:01
 */

namespace App\Http\View\Composers;

use App\Interfaces\Blog\TagInterface;
use Illuminate\View\View;

class TagComposer
{

    protected $tags;

    public function __construct(TagInterface $tagContract)
    {

        $this->tags = $tagContract;
    }

    public function compose(View $view)
    {

        $tags = $this->tags
            ->allActive()
            ->pluck('tag', 'id');

        $view->with('tagSelect', $tags);
    }
}
