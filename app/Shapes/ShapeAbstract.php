<?php

namespace App\Shapes;

/**
 *
 */
abstract class ShapeAbstract
{
    protected $attributes;

    function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function getAttribute($name)
    {
        return $this->attributes[$name];
    }
}