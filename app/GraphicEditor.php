<?php

namespace App;

use App\Shapes\ShapeFactory;
use App\Drivers\DriverFactory;

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
            $this->shapes[] = $this->shape_factory->create($shape_data);
        }
    }

    public function draw($driver_name)
    {
        $resource = null;
        $shift_x = 0;

        foreach ($this->shapes as $shape) {
            $driver = $this->driver_factory->create($shape, $driver_name, 700, 700);
            // dd($driver->draw($resource, $shift_x));
            list($resource, $shift_x) = $driver->draw($resource, $shift_x);

        }
        // dd($resource);
        return $resource;
    }
}