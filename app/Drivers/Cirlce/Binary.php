<?php

namespace App\Drivers\Circle;

use App\Drivers\DriverAbstract;
use App\Drivers\BinaryRendererTrait;

class Binary extends DriverAbstract
{
    use BinaryRendererTrait, BinaryDrawerTrait;

}