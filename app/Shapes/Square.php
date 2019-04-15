<?php

namespace App\Shapes;

/**
 *
 */
class Square extends ShapeAbstract
{
    /**
     * check if the square has the required attributes
     *
     * @param array $attributes
     * @return bool
     */
    public function validate(array $attributes)
    {
        if (! isset($attributes['sideLength'])) {
            throw new \LogicException("Please define 'sideLength' of the square");
        }

        return true;
    }

    /**
     * the width of the shape on the canvas
     *
     * @param int $border_width
     * @return int
     */

    protected function width(int $border_width)
    {
        return $this->get('sideLength') + $border_width;
    }

    /**
     * the height of the shape on the canvas
     *
     * @param int $border_width
     * @return int
     */
    protected function height(int $border_width)
    {
        return $this->get('sideLength') + $border_width;
    }

}