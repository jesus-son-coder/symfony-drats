<?php
/**
 * Created by PhpStorm.
 * User: sekaherve
 * Date: 10/05/2019
 * Time: 22:21
 */

namespace App\Twig;


use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('price', [$this, 'priceFilter'])
        ];
    }

    public function priceFilter($number)
    {
        return '$' . number_format($number, 2, ',', '.');
    }

}