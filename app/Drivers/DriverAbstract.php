<?php

namespace App\Drivers;

use App\Format\FormatAbstract;
use App\Shapes\ShapeAbstract;

abstract class DriverAbstract
{

    protected $shape;

    protected $format;


    public function __construct(ShapeAbstract $shape, FormatAbstract $format)
    {
        $this->shape  = $shape;
        $this->format = $format;
    }

    abstract public function render(): FormatAbstract;
}