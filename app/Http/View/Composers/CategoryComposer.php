<?php
/**
 * Created by PhpStorm.
 * User: josejesus
 * Date: 2020-06-01
 * Time: 16:01
 */

namespace App\Http\View\Composers;

use App\Interfaces\Blog\CategoryInterface;
use Illuminate\View\View;

class CategoryComposer
{

    protected $categories;

    public function __construct(CategoryInterface $categoryContract)
    {

        $this->categories = $categoryContract;
    }

    public function compose(View $view)
    {

        $categories = $this->categories->allActive()->pluck('category', 'id');
        $view->with('categorySelect', $categories);
    }
}
