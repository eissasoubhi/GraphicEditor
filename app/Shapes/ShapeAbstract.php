<?php

namespace App\Shapes;

use Illuminate\Support\Arr;
use App\Shapes\Attributes\Color;

abstract class ShapeAbstract
{
    protected $attributes = [];

    final public function __construct(array $attributes)
    {
        if ($this->validate($attributes)) {
            foreach ($attributes as $name => $value) {

                if ($name == 'border' && isset($value['color'])) {
                    $value['color'] = new Color($value['color']);
                }

                if ($name == 'color' ) {
                    $value = new Color($value);
                }

                $this->attributes[$name] = $value;
            }
        }
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

        return Arr::get($this->attributes, $key);
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