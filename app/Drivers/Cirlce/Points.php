<?php

namespace App\Drivers\Circle;

use App\Drivers\DriverAbstract;
use App\Drivers\BinaryRendererTrait;

class Points extends DriverAbstract
{
    use BinaryRendererTrait, BinaryDrawerTrait;
}