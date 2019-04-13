<?php

namespace App\Shapes;

use Illuminate\Support\Arr;
use App\Shapes\Attributes\AttributeFactory;
use App\Shapes\Attributes\AttributeAbstract;

abstract class ShapeAbstract
{
    protected $attributes = [];

    protected $attribute_factory;

    final public function __construct(array $attributes, AttributeFactory $attribute_factory)
    {
        $this->attribute_factory = $attribute_factory;

        if ($this->validate($attributes)) {
            $this->attributes = $this->checkInstanciableAttributes($attributes);
        }
    }

    protected function checkInstanciableAttributes($attributes)
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

    abstract public function validate(array $attributes);

    abstract protected function width($border_width);

    abstract protected function height($border_width);

    public function has($key)
    {
        return Arr::has($this->attributes, $key);
    }

    public function get($key)
    {
        if(!$this->has($key)){
            throw new \LogicException("Attribute {$key} is not defined");
        }

        $keys = explode('.', $key);
        $name = end($keys);

        $value = Arr::get($this->attributes, $key);

        if ($value instanceof AttributeAbstract) {
            return $value->getValue();
        }

        return $value;
    }

    public function getBorderWidth()
    {
        if ($this->has('border.width')) {
            return $this->get('border.width');
        }

        return 1;
    }


    public function getWidth($with_borders = false)
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


    public function getHeight($with_borders = false)
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