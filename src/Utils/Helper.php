<?php

namespace Oshop\Utils;

class Helper
{
    public static function getStars($rate)
    {
        return str_repeat('<i class="fa fa-star"></i>', $rate) . str_repeat('<i class="fa fa-star-o"></i>', 5 - $rate);
    }
}