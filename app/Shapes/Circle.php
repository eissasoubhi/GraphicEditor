<?php

namespace App\Shapes;

use App\Shapes\ShapeAbstract;
/**
 *
 */
class Circle extends ShapeAbstract
{

    public function validate(array $attributes)
    {
        if (! isset($attributes['perimeter'])) {
            throw new \LogicException("Please define 'perimeter' of the circle");
        }

        return true;
    }

    protected function width($border_width)
    {
        return $this->get('perimeter') / pi() + $border_width;
    }

    protected function height($border_width)
    {
        return $this->get('perimeter') / pi() + $border_width;
    }

}