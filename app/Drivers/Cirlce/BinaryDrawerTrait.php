<?php

namespace App\Drivers\Circle;

/**
 * This trait functions are shared between both the Binary and the Points drivers of circles
 */
trait BinaryDrawerTrait {

    /**
     * draw a cirlcle in the canvas
     */
    public function draw()
    {
        imagesetthickness($this->format->getResource(), $this->shape->getBorderWidth());

        $color = [0, 0, 0];
        if ($this->shape->has('border.color')) {
            $color = $this->shape->get('border.color');
        }

        $color = \imagecolorallocate($this->format->getResource(), $color[0], $color[1], $color[2]);

        \imagearc(
            $this->format->getResource(),
            // the x position of the center of the circle
            $this->format->getCurrentXposition() + ($this->shape->getWidth() / 2),
            // the y position of the center of the circle
            $this->format->getCurrentYposition() + ($this->shape->getWidth() / 2),
            $this->shape->getWidth(),
            $this->shape->getWidth(),
            0,
            360,
            $color
        );
    }
}