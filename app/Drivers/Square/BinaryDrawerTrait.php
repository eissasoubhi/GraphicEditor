<?php

namespace App\Drivers\Square;

trait BinaryDrawerTrait {

    public function draw()
    {
        $color = [0, 0, 0];
        if ($this->shape->has('border.color')) {
            $color = $this->shape->get('border.color');
        }

        $color = \imagecolorallocate($this->format->getResource(), $color[0], $color[1], $color[2]);

        \imagerectangle(
            $this->format->getResource(),
            $this->format->getCurrentXposition(),
            $this->format->getCurrentYposition(),
            $this->format->getCurrentXposition() + $this->shape->get('sideLength'),
            $this->format->getCurrentYposition() + $this->shape->get('sideLength'),
            $color
        );
    }
}