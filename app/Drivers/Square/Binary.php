<?php

namespace App\Drivers\Square;

use App\Drivers\DriverAbstract;
use App\Drivers\BinaryRendererTrait;

class Binary extends DriverAbstract
{
    use BinaryRendererTrait, BinaryDrawerTrait;

}