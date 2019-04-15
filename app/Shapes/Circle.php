<?php

namespace App\Shapes;

use App\Shapes\ShapeAbstract;
/**
 *
 */
class Circle extends ShapeAbstract
{

    /**
     * check if the circle has the required attributes
     *
     * @param array $attributes
     * @return bool
     */
    public function validate(array $attributes)
    {
        if (! isset($attributes['perimeter'])) {
            throw new \LogicException("Please define 'perimeter' of the circle");
        }

        return true;
    }

    /**
     * @param string $border_width
     * @return int
     */
    protected function width(int $border_width)
    {
        return $this->get('perimeter') / pi() + $border_width;
    }

    /**
     * @param string $border_width
     * @return int
     */
    protected function height(int $border_width)
    {
        return $this->get('perimeter') / pi() + $border_width;
    }

}