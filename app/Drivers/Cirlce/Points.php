<?php

namespace App\Drivers\Circle;

use App\Drivers\DriverAbstract;
use App\Drivers\BinaryRendererTrait;

/**
 * This Points driver has  simalar functionalities as the Binary driver
 * because it depends on it for the reason that we need to draw a binary image
 * of the circle first then later convert it to an array of pixels.
 *
 * @see App\Drivers\Circle\BinaryDrawerTrait;
 * @see App\Drivers\Circle\BinaryRendererTrait;
 */
class Points extends DriverAbstract
{
    use BinaryRendererTrait, BinaryDrawerTrait;
}