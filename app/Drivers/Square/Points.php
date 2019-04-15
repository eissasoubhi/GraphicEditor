<?php

namespace App\Drivers\Square;

use App\Drivers\DriverAbstract;
use App\Drivers\BinaryRendererTrait;

/**
 * This Points driver has simalar functionalities as the Binary driver
 * because it depends on it for the reason that we need to draw a binary image
 * of the square first then later convert it to an array of pixels.
 *
 * @see App\Drivers\Square\BinaryDrawerTrait;
 * @see App\Drivers\Square\BinaryRendererTrait;
 */
class Points extends DriverAbstract
{
    use BinaryRendererTrait, BinaryDrawerTrait;

}