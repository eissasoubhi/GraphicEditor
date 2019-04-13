<?php

namespace App\Shapes;

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

        return new $class($attributes);
    }

    protected function getClassShortName($class) {
        $namespace = explode('\\', $class);
        return array_pop($namespace);
    }
}