<?php

namespace App\Shapes;

use App\Shapes\Attributes\AttributeFactory;
/**
 *
 */
class ShapeFactory
{

    public function create($type, array $attributes): ShapeAbstract
    {
        $class = 'App\\Shapes\\'.ucfirst(strtolower($type));

        $type = $this->getClassShortName($class);

        if (! class_exists($class)) {
            throw new \RuntimeException("The shape of type $type does not exist");
        }

        return new $class($attributes, new AttributeFactory);
    }

    protected function getClassShortName($class) {
        $namespace = explode('\\', $class);
        return array_pop($namespace);
    }
}