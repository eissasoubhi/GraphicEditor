<?php

namespace App\Drivers\Circle;

use App\Drivers\BinaryDriver;

/**
 *
 */
class Binary extends BinaryDriver
{

    public function draw($resource, $shift_x)
    {
        $this->setResource($resource);

        $border_width = $this->shape->getAttribute('border')['width'];
        $border_overflow = $border_width/2;
        imagesetthickness($this->getResource(), $border_width);

        $border_color = $this->getBorderColor();

        imagearc(
            $this->getResource(),
            ($this->calculateDiameter() / 2)+$shift_x+$border_overflow , // x
            $this->calculateDiameter() / 2+$border_overflow , // y
            $this->calculateDiameter(),
            $this->calculateDiameter(),
            0,
            360,
            $border_color
        );

        return [$this->getResource(), $this->calculateDiameter()+$shift_x+$border_width ];
    }


    public function calculateDiameter()
    {
        return $this->shape->getAttribute('perimeter') / pi();
    }

}