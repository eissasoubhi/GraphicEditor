<?php

namespace App;

use App\Drivers\DriverFactory;
use App\Shape\ShapeAbstract;
use App\Format\FormatAbstract;
use App\Shapes\ShapeFactory;

/**
 * orchestrate the components (the classes) to produce the dsired result
 */
class GraphicEditor
{
    /**
     * @var App\Drivers\DriverFactory
     */
    protected $shape_factory;

    /**
     * @var App\Shapes\ShapeFactory
     */
    protected $driver_factory;

    /**
     * @var array
     */
    protected $shapes = [];

    /**
     * @param App\Drivers\DriverFactory $driver_factory
     * @param App\Shapes\ShapeFactory $shape_factory
     */
    function __construct(ShapeFactory $shape_factory, DriverFactory $driver_factory)
    {
        $this->shape_factory = $shape_factory;
        $this->driver_factory = $driver_factory;
    }

    /**
     * @param array $shapes_array
     */
    public function load(array $shapes_array)
    {
        foreach ($shapes_array as $shape_data) {
            $this->shapes[] = $this->shape_factory->create($shape_data['type'], $shape_data);
        }
    }

    /**
     * @param App\Format\FormatAbstract $format
     * @return Illuminate\Http\Response
     */
    public function draw(FormatAbstract $format)
    {
        foreach ($this->shapes as $shape) {
            $driver = $this->driver_factory->create($shape, $format);
            $format = $driver->render();
        }

        return $format->getResponse();
    }
}