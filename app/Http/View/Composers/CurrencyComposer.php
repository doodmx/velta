<?php
/**
 * Created by PhpStorm.
 * User: josejesus
 * Date: 2020-06-01
 * Time: 16:01
 */

namespace App\Http\View\Composers;

use App\Interfaces\Payment\CurrencyInterface;
use Illuminate\View\View;

class CurrencyComposer
{

    protected $currencies;

    public function __construct(CurrencyInterface $currencyContract)
    {

        $this->currencies = $currencyContract;
    }

    public function compose(View $view)
    {

        $view->with('currencies', $this->currencies->all()->pluck('iso_code', 'id'));
    }
}
