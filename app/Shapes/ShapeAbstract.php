<?php

namespace App\Shapes;

use Illuminate\Support\Arr;
use App\Shapes\Attributes\AttributeFactory;
use App\Shapes\Attributes\AttributeAbstract;

abstract class ShapeAbstract
{
    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * @var App\Shapes\Attributes\AttributeFactory
     */
    protected $attribute_factory;

    /**
     * @param array $attributes
     * @param App\Shapes\Attributes\AttributeFactory $attribute_factory
     */
    final public function __construct(array $attributes, AttributeFactory $attribute_factory)
    {
        $this->attribute_factory = $attribute_factory;

        if ($this->validate($attributes)) {
            $this->attributes = $this->checkInstanciableAttributes($attributes);
        }
    }

    /**
     * loop over the array attributes and instanciate any attribute that has an instanciable class
     *
     * @param array $attributes
     * @return array
     */
    protected function checkInstanciableAttributes(array $attributes)
    {

        foreach ($attributes as $name => $value) {

            if (is_array($value)) {
                $attributes[$name] = $this->checkInstanciableAttributes($value);
            } else {

                if ($this->attribute_factory->attributeExists($name)) {
                    $value = $this->attribute_factory->create($name, $value);
                }

                $attributes[$name] = $value;
            }
        }

        return $attributes;
    }

    /**
     * check if the shape has the required attributes
     *
     * @param array $attributes
     * @return bool
     */
    abstract public function validate(array $attributes);

    /**
     * the width of the shape on the canvas
     *
     * @param int $border_width
     * @return int
     */
    abstract protected function width(int $border_width);

    /**
     * the height of the shape on the canvas
     *
     * @param int $border_width
     * @return int
     */
    abstract protected function height(int $border_width);

    /**
     * whether the shape has an attibute or not
     *
     * @param string $key
     * @return bool
     */
    public function has(string $key)
    {
        return Arr::has($this->attributes, $key);
    }

    /**
     * get an attibute of the shape
     *
     * @param string $key
     * @return string
     */
    public function get(string $key)
    {
        if(! $this->has($key)){
            throw new \LogicException("Attribute {$key} is not defined");
        }

        $keys = explode('.', $key);
        $name = end($keys);

        // we can use dot notation here eg: border.width
        $value = Arr::get($this->attributes, $key);

        if ($value instanceof AttributeAbstract) {
            return $value->getValue();
        }

        return $value;
    }

    /**
     * @return int
     */
    public function getBorderWidth()
    {
        if ($this->has('border.width')) {
            return $this->get('border.width');
        }

        // the default value
        return 1;
    }


    /**
     * the width of the shape on the canvas
     *
     * @param bool $with_borders
     */
    public function getWidth(bool $with_borders = false)
    {
        $border_width = 0;

        if ($with_borders) {
            $border_width = $this->getBorderWidth();
            if ($this->has('border.width')) {
                $border_width = $this->get('border.width');
            }
        }

        return $this->width($border_width);
    }

    /**
     * the height of the shape on the canvas
     *
     * @param bool $with_borders
     */
    public function getHeight(bool $with_borders = false)
    {
        $border_width = 0;

        if ($with_borders) {
            $border_width = $this->getBorderWidth();
            if ($this->has('border.width')) {
                $border_width = $this->get('border.width');
            }
        }

        return $this->height($border_width);
    }
}