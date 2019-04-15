<?php

namespace App\Format;

use App\Shapes\ShapeAbstract;

abstract class FormatAbstract
{
    /**
     * The width of the canvas
     * @var int
     */
    protected $width;

    /**
     * The height of the canvas
     * @var int
     */
    protected $height;

    /**
     * The background color of the canvas
     * @var array
     */
    protected $background_color;

    /**
     * The store of the canvas
     * @var resource
     */
    protected $resource = null;

    /**
     * The drawn shapes on the canvas
     * @var array
     */
    protected $rended_shapes = [];

    final public function __construct(int $width, int $height, array $background_color = [255, 255, 255])
    {
        $this->width           = $width;
        $this->height          = $height;
        $this->background_color = $background_color;
    }

    /**
     * @return resource
     */
    abstract protected function getCanvas();

    /**
     * @return Illuminate\Http\Response
     */
    abstract public function getResponse();

    /**
     * @return resource
     */
    public function getResource()
    {
        if (is_null($this->resource)) {
            $this->resource = $this->getCanvas();
        }

        return $this->resource;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @return array
     */
    public function getBackgroundColor()
    {
        return $this->background_color;
    }

    /**
     * @param App\Shapes\ShapeAbstract @shape
     */
    public function addRendedShape(ShapeAbstract $shape)
    {
        $this->rended_shapes[] = $shape;
    }
}