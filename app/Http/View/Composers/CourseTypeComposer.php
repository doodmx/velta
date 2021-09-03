<?php
/**
 * Created by PhpStorm.
 * User: josejesus
 * Date: 2020-06-01
 * Time: 16:01
 */

namespace App\Http\View\Composers;

use App\Interfaces\Course\CourseTypeInterface;
use Illuminate\View\View;

class CourseTypeComposer
{

    protected $courseTypes;

    public function __construct(CourseTypeInterface $courseTypeContract)
    {

        $this->courseTypes = $courseTypeContract;
    }

    public function compose(View $view)
    {

        $courseTypes = $this->courseTypes->allActive()->pluck('name', 'id');
        $view->with('courseTypeSelect', $courseTypes);
    }
}
