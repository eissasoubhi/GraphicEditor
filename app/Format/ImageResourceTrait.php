<?php

namespace App\Format;

/**
 * This trait functions are shared between both the Binary and the Points format.
 */
trait ImageResourceTrait {

    /**
     * Creates a canvas image
     *
     * @return resource
     */
    public function getCanvas()
    {
        $image = \imagecreatetruecolor($this->width, $this->height);
        $color = \imagecolorallocate(
            $image,
            $this->background_color[0],
            $this->background_color[1],
            $this->background_color[2]
        );
        \imagefilledrectangle($image, 0, 0, $this->width, $this->height, $color);

        return $image;
    }
}