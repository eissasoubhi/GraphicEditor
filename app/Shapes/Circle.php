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