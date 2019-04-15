<?php

namespace App\Drivers\Circle;

use App\Drivers\DriverAbstract;
use App\Drivers\BinaryRendererTrait;

/**
 * This Binary driver renders the input data of a circle into a binary image.
 *
 * @see App\Drivers\Circle\BinaryDrawerTrait;
 * @see App\Drivers\Circle\BinaryRendererTrait;
 */
class Binary extends DriverAbstract
{
    use BinaryRendererTrait, BinaryDrawerTrait;

}