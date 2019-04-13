<?php

namespace App;

use App\Drivers\DriverFactory;
use App\Shape\ShapeAbstract;
use App\Format\FormatAbstract;
use App\Shapes\ShapeFactory;

/**
 *
 */
class GraphicEditor
{
    protected $shape_factory;

    protected $driver_factory;

    protected $shapes = [];

    function __construct(ShapeFactory $shape_factory, DriverFactory $driver_factory)
    {
        $this->shape_factory = $shape_factory;
        $this->driver_factory = $driver_factory;
    }

    public function load(array $shapes_array)
    {
        foreach ($shapes_array as $shape_data) {
            $this->shapes[] = $this->shape_factory->create($shape_data['type'], $shape_data);
        }
    }

    public function draw(FormatAbstract $format)
    {
        foreach ($this->shapes as $shape) {
            $driver = $this->driver_factory->create($shape, $format);
            $format = $driver->render();
        }

        return $format->getResponse();
    }
}