<?php

namespace App\Format;

trait ImageResourceTrait {

    public function activateResource()
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