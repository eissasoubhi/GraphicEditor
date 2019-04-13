<?php

namespace App\Drivers\Square;

use App\Drivers\DriverAbstract;
use App\Drivers\BinaryRendererTrait;

class Points extends DriverAbstract
{
    use BinaryRendererTrait, BinaryDrawerTrait;

}