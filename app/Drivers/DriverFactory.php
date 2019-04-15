<?php

namespace App\Drivers;

use App\Shapes\ShapeAbstract;
use App\Format\FormatAbstract;

class DriverFactory
{

    /**
     * @param App\Shapes\ShapeAbstract $shape
     * @param App\Shapes\FormatAbstract $format
     * @return App\Drivers\DriverAbstract
     */
    public function create(ShapeAbstract $shape, FormatAbstract $format)
    {
        $_shape = (new \ReflectionClass($shape))->getShortName();
        $_driver = (new \ReflectionClass($format))->getShortName();

        $class = 'App\\Drivers\\'.$_shape.'\\'.$_driver;

        if (! class_exists($class)) {
            throw new \Exception("The driver $_driver for the shape $_shape is not implimented", 1);
        }

        return new $class($shape, $format);
    }
}