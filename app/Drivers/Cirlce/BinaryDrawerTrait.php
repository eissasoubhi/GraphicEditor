<?php

namespace App\Drivers\Circle;

trait BinaryDrawerTrait {

    public function draw()
    {
        $color = [0, 0, 0];
        if ($this->shape->has('border.color')) {
            $color = $this->shape->get('border.color')->getValue();
        }

        $color = \imagecolorallocate($this->format->getResource(), $color[0], $color[1], $color[2]);

        \imagearc(
            $this->format->getResource(),
            $this->format->getCurrentXposition() + ($this->shape->getWidth() / 2),
            $this->format->getCurrentYposition() + ($this->shape->getWidth() / 2),
            $this->shape->getWidth(),
            $this->shape->getWidth(),
            0,
            360,
            $color
        );
    }
}