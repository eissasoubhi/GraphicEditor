<?php

namespace App\Drivers;

use App\Format\FormatAbstract;
use App\Shapes\ShapeAbstract;

abstract class DriverAbstract
{
    /**
     * @var App\Shapes\ShapeAbstract
     */
    protected $shape;

    /**
     * @var App\Shapes\FormatAbstract
     */
    protected $format;

    /**
     * @param App\Shapes\ShapeAbstract $shape
     * @param App\Shapes\FormatAbstract $format
     */
    final public function __construct(ShapeAbstract $shape, FormatAbstract $format)
    {
        $this->shape  = $shape;
        $this->format = $format;
    }

    /**
     * @return App\Format\FormatAbstract
     */
    abstract public function render(): FormatAbstract;
}