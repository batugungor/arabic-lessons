<?php

namespace App\Extentions;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class TwigExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
//            new TwigFilter('price', [$this, 'formatPrice']),
        ];
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('joinByKey', [$this, 'joinByKey']),
        ];
    }

    public function joinByKey($array, $key): string
    {
        $string = '';

        foreach ($array as $item) {
            $string .= $item[$key];
        }

        return $string;
    }

}