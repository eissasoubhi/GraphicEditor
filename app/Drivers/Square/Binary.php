<?php

namespace App\Drivers\Square;

use App\Drivers\DriverAbstract;

class Binary extends DriverAbstract
{
    public function draw()
    {
        $color = [0, 0, 0];
        if ($this->shape->has('border.color')) {
            $color = $this->shape->get('border.color')->getValue();
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