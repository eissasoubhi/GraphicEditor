<?php

namespace App\Format;

use App\Shapes\ShapeAbstract;

abstract class FormatAbstract
{
    protected $width;

    protected $height;

    protected $background_color;

    protected $resource = null;

    protected $rended_shapes = [];

    public function __construct(int $width, int $height, array $background_color = [255, 255, 255])
    {
        $this->width           = $width;
        $this->height          = $height;
        $this->background_color = $background_color;
    }

    abstract protected function activateResource();

    abstract public function getResponse();

    public function getResource()
    {
        if (is_null($this->resource)) {
            $this->resource = $this->activateResource();
        }

        return $this->resource;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function getBackgroundColor()
    {
        return $this->background_color;
    }

    public function addRendedShape(ShapeAbstract $shape)
    {
        $this->rended_shapes[] = $shape;
    }
}