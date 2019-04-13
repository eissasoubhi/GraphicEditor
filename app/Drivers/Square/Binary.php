<?php

namespace App\Drivers\Square;

use App\Drivers\BinaryDriver;

/**
 *
 */
class Binary extends BinaryDriver
{
    public function draw($resource, $shift_x)
    {
        // dd($shift_x);
        $this->setResource($resource);

        $border_width = $this->shape->getAttribute('border')['width'];
        $border_overflow = $border_width/2;
        imagesetthickness($this->getResource(), $border_width);

        $border_color = $this->getBorderColor();

        \imagerectangle(
            $this->getResource(),
            $shift_x+$border_overflow ,
            $border_overflow ,
            $this->shape->getAttribute('sideLength')+$shift_x+$border_overflow ,
            $this->shape->getAttribute('sideLength'),
            $border_color
        );

        return [$this->getResource(), $this->shape->getAttribute('sideLength')+$shift_x+$border_width];
    }
}