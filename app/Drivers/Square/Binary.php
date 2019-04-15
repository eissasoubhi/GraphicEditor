<?php

namespace App\Drivers\Square;

use App\Drivers\DriverAbstract;
use App\Drivers\BinaryRendererTrait;

/**
 * This Binary driver renders the input data of a square into a binary image.
 *
 * @see App\Drivers\Square\BinaryDrawerTrait;
 * @see App\Drivers\Square\BinaryRendererTrait;
 */
class Binary extends DriverAbstract
{
    use BinaryRendererTrait, BinaryDrawerTrait;

}