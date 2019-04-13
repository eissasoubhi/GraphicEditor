<?php

namespace App\Drivers;

use App\Shapes\ShapeAbstract;

/**
 *
 */
class DriverFactory
{

    public function create(ShapeAbstract $shape, string $driver_name, int $width, int $height)
    {
        $_shape = (new \ReflectionClass($shape))->getShortName();
        $_driver = ucfirst($driver_name);

        $class = 'App\\Drivers\\'.$_shape.'\\'.$_driver;

        if (! class_exists($class)) {
            throw new \Exception("The driver $_driver for the shape $_shape is not implimented", 1);
        }

        return new $class($shape, $width, $height);
    }
}