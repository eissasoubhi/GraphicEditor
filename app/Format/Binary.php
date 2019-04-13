<?php

namespace App\Format;

use App\Shapes\ShapeAbstract;

class Binary extends FormatAbstract
{
    protected $width;

    protected $height;

    protected $background_color;

    protected $current_x_posotion = 0;

    protected $current_y_posotion = 0;

    protected $rended_shapes = [];

    public function __construct(int $width, int $height, array $background_color = [255, 255, 255])
    {
        $this->width           = $width;
        $this->height          = $height;
        $this->background_color = $background_color;
    }

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

    public function shiftCurrentXposition($x)
    {
        $this->current_x_posotion += $x;
    }

    public function getCurrentXposition()
    {
        return $this->current_x_posotion;
    }

    public function shiftCurrentYposition($y)
    {
        $this->current_y_posotion += $y;
    }

    public function getCurrentYposition()
    {
        return $this->current_y_posotion;
    }

    public function resetCurrentXposition($x)
    {
        $this->current_x_posotion = $x;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function addRendedShape(ShapeAbstract $shape)
    {
        $this->rended_shapes[] = $shape;
    }

    public function biggestYpostion()
    {
        if (! count($this->rended_shapes)) {
            return 0;
        }

        $longest_shape = array_reduce($this->rended_shapes, function ($max, $current)
        {
            return $current > $max ? $current : $max;
        });

        return $longest_shape->getHeight(true);
    }
}