<?php

namespace App\Shapes;

/**
 *
 */
class Square extends ShapeAbstract
{

    public function validate(array $attributes)
    {
        return true;
    }

    protected function width($border_width)
    {
        return $this->get('sideLength') + $border_width;
    }

    protected function height($border_width)
    {
        return $this->get('sideLength') + $border_width;
    }

}