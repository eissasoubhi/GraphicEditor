<?php

namespace App\Drivers;

use App\Shapes\ShapeAbstract;

/**
 *
 */
abstract class BinaryDriver
{
    protected $resource = null;
    protected $shape;
    protected $width;
    protected $height;

    function __construct(ShapeAbstract $shape, int $width, int $height)
    {
        $this->shape = $shape;
        $this->width = $width;
        $this->height = $height;
    }

    public function getResource()
    {
        if (! $this->resource ) {

            $image = \imagecreatetruecolor($this->width, $this->height);

            $color = \imagecolorallocate($image, 0, 0, 0 );

            \imagefilledrectangle($image, 0, 0, $this->width, $this->height, $color);

            $this->resource = $image;
        }

        return $this->resource;
    }

    public function setResource($resource = null)
    {
        $this->resource = $resource;
    }

    public function getRgbColor()
    {
        return sscanf($this->shape->getAttribute('border')['color'], "#%02x%02x%02x");
    }

    public function getBorderColor()
    {
        list($r, $g, $b) = $this->getRgbColor();

        return \imagecolorallocate($this->getResource(), $r, $g, $b );
    }

    abstract public function draw($resource, $shift_x);
}